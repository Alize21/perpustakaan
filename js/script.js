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
