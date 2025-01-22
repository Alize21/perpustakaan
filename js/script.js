const tambahBuku = document.querySelector(".tambah-buku");
const insertMenu = document.querySelector(".insert-menu");
const closeButton = document.querySelector(".close");

// munculkan menu insert
tambahBuku.onclick = () => {
  insertMenu.style.display = "flex";
};

if (closeButton) {
  closeButton.onclick = () => {
    insertMenu.style.display = "none";
  };
}

document.addEventListener("click", function (e) {
  if (!insertMenu.contains(e.target) && insertMenu.style.display === "flex" && !tambahBuku.contains(e.target)) {
    insertMenu.style.display = "none";
  }
});
