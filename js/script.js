const tambahBuku = document.querySelector(".tambah-buku");
const insertMenu = document.querySelector(".insert-menu");
const closeButton = document.querySelector(".close");
const keyword = document.querySelector("#keyword");
const content = document.querySelector(".content");

// live search menggunakan ajax
keyword.addEventListener("input", function () {
  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      content.innerHTML = xhr.responseText;
    }
  };

  xhr.open("GET", "ajax/books.php?keyword=" + keyword.value, true);
  xhr.send();
});

// munculkan menu insert
tambahBuku.onclick = () => {
  insertMenu.style.display = "block";
};
if (closeButton) {
  closeButton.onclick = () => {
    insertMenu.style.display = "none";
  };
}
document.addEventListener("click", function (e) {
  if (!insertMenu.contains(e.target) && insertMenu.style.display === "block" && !tambahBuku.contains(e.target)) {
    insertMenu.style.display = "none";
  }
});

// mencegah user memasukkan gambar kosong ke database
document.querySelector(".insert-menu").addEventListener("submit", function (e) {
  const inputFile = document.querySelector("#inputFile");
  if (!inputFile.files.length) {
    e.preventDefault();
    alert("please insert image first");
  }
});
