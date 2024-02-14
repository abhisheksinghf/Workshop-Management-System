let currentPage = 1;
const formData = {};

function navigatePage(pageNumber) {
    saveFormData();
    currentPage = pageNumber;
    showPage(currentPage);
    loadFormData();
}
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".custom-checkbox");
  
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener("click", function () {
        checkboxes.forEach(function (otherCheckbox) {
          if (otherCheckbox !== checkbox && otherCheckbox.name === checkbox.name) {
            otherCheckbox.checked = false;
          }
        });
      });
    });
  });
  
function showPage(pageNumber) {
    const pages = document.querySelectorAll('[id^="page"]');
    pages.forEach((page) => {
        page.style.display = 'none';
    });

    const currentPageId = `page${pageNumber}`;
    document.getElementById(currentPageId).style.display = 'flex';
}

function saveFormData() {
    const inputs = document.querySelectorAll('#page' + currentPage + ' input, #page' + currentPage + ' textarea');
    inputs.forEach((input) => {
        formData[input.name] = input.value;
    });
}

function loadFormData() {
    const inputs = document.querySelectorAll('#page' + currentPage + ' input, #page' + currentPage + ' textarea');
    inputs.forEach((input) => {
        input.value = formData[input.name] || '';
    });
}

document.getElementById('multi-page-form').addEventListener('submit', function (e) {
    e.preventDefault();
    saveFormData();

    // Gather form data and send it to the backend (you can replace this with your backend URL and method).
    console.log('Data to be sent to the backend:', formData);
});

// Initially, show the first page.
showPage(currentPage);