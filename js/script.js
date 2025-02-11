const tambahBuku = document.querySelector(".tambah-buku");
const tambahBukuRes = document.querySelector(".tambah-buku-res");
const insertMenu = document.querySelector(".insert-menu");
const closeButton = document.querySelector(".close");
const keyword = document.querySelector("#keyword");
const content = document.querySelector(".content");
const menu = document.querySelector("#menu");
const navbar = document.querySelector(".navbar");

// munculkan menu insert
tambahBuku.onclick = () => {
  insertMenu.style.display = "block";
  document.body.classList.add("no-scroll");
};
tambahBukuRes.onclick = () => {
  insertMenu.style.display = "inline-block";
  document.body.classList.add("no-scroll");
  navbar.classList.remove("navbar-active");
};

if (closeButton) {
  closeButton.onclick = () => {
    insertMenu.style.display = "none";
    document.body.classList.remove("no-scroll");
  };
}
document.addEventListener("click", function (e) {
  if (!insertMenu.contains(e.target) && insertMenu.style.display === "block" && !tambahBuku.contains(e.target)) {
    insertMenu.style.display = "none";
    document.body.classList.remove("no-scroll");
  }

  // hilangkan hamburger menu
  if (!navbar.contains(e.target) && !menu.contains(e.target)) {
    navbar.classList.remove("navbar-active");
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

// munculkan hamburger menu
menu.onclick = () => {
  navbar.classList.toggle("navbar-active");
};

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
