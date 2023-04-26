fetch("https://127.0.0.1:8000/reservation").then((response) => {
  console.log(response);
  return response();
});
