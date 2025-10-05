const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const folder = document.querySelector(".folder");

sign_up_btn.addEventListener("click", () => {
  folder.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  folder.classList.remove("sign-up-mode");
});
