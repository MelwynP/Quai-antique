<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
  //Cette propriété contient les paramètres de l'application |service.yaml
  private $params;

  public function __construc(ParameterBagInterface $params)
  {
    $this->params = $params;
  }

  public function add(UploadedFile $picture, ?string $folder = '', ?int $width = 250, ?int $height = 250)
  {
    // On donne un nouveau nom à l'image
    $fichier = md5(uniqid(rand(), true)) . '.webp';

    //On récupère les infos de l'image
    $pictureInfos = getimagesize($picture);

    if($pictureInfos === false) {
      throw new \Exception('Format d\'image incorrect');
    }

    // On vérifie le format de l'image
    switch ($pictureInfos['mime']) {
      case 'image/jpeg':
        $image = imagecreatefromjpeg($picture);
        break;
      case 'image/png':
        $image = imagecreatefrompng($picture);
        break;
      case 'image/webp':
        $image = imagecreatefromwebp($picture);
        break;
      default:
        throw new \Exception('Format d\'image incorrect');
    }

    // On redimensionne l'image et on récupère les dimensions
    $imageWidth = $pictureInfos[0];
    $imageHeight = $pictureInfos[1];

    // On vérifie l'orientation de l'image
    switch ($imageWidth <=> $imageHeight){
      case -1: // portrait
        $imageWidth = $imageHeight;
        break;
      case 0: // carré
        $squareSize = $imageWidth;
        $src_x = 0;
        $src_y = 0;
        break;
      case 1: // paysage
        $squareSize = $imageWidth;
        $src_x = ($imageWidth - $squareSize) / 2;
        $src_y = 0;
        break;
    }

    // On crée une image vierge aux dimensions souhaitées
    $newImage = imagecreatetruecolor($width, $height);

    imagecopyresampled($newImage, $image, 0, 0, $src_x, $src_y, $width, $height, $squareSize, $squareSize);
    // On récupère le chemin du dossier de stockage des images
    $path = $this->params->get('photo_dir') . $folder;

    // On crée le dossier s'il n'existe pas
    if (!file_exists($path . '/mini/')) {
      mkdir($path .'/mini/', 0755, true);
    }
// On stocke l'image recadrée
        imagewebp($newImage, $path . '/mini/' . $width . 'x' . $height . '-' . $fichier);

        $picture->move($path . '/', $fichier);

        return $fichier;
    }

    public function delete(string $fichier, ?string $folder = '', ?int $width = 250, ?int $height = 250)
    {
        if($fichier !== 'default.webp'){
            $success = false;
            $path = $this->params->get('photo_dir') . $folder;

            $mini = $path . '/mini/' . $width . 'x' . $height . '-' . $fichier;

            if(file_exists($mini)){
                unlink($mini);
                $success = true;
            }

            $original = $path . '/' . $fichier;

            if(file_exists($original)){
                unlink($original);
                $success = true;
            }
            return $success;
        }
        return false;
    }
}