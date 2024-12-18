document.addEventListener('DOMContentLoaded', function () {
  const sections = document.querySelectorAll('.content-section');
  const navLinks = document.querySelectorAll('.nav-links a');

  function hideAllSections() {
    sections.forEach(section => section.style.display = 'none');
  }

  function showSection(sectionId) {
    document.getElementById(sectionId).style.display = 'block';
  }

  navLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      hideAllSections();
      showSection(this.getAttribute('href').substring(1));
    });
  });

  document.querySelector('.btn-home').addEventListener('click', function (e) {
    e.preventDefault();
    hideAllSections();
    showSection('posts');
  });

  hideAllSections();
  showSection('home');

  document.getElementById('signup-form').addEventListener('submit', function (e) {
    e.preventDefault();
    hideAllSections();
    showSection('home');
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('like-btn')) {
      const likeCountElement = e.target.nextElementSibling;
      let likeCount = parseInt(likeCountElement.textContent) || 0;
      likeCount++;
      likeCountElement.textContent = `${likeCount} Likes`;
    }
  });
});

function addComment(inputId, listId) {
  const commentInput = document.getElementById(inputId);
  const commentText = commentInput.value.trim();
  if (commentText) {
    const commentsList = document.getElementById(listId);
    const newComment = document.createElement('li');
    newComment.textContent = commentText;
    commentsList.appendChild(newComment);
    commentInput.value = '';
  }
}
document.addEventListener('DOMContentLoaded', function () {
  const recipesLink = document.getElementById('recipes-link');
  const dessertLink = document.getElementById('dessert-link');
  const budgetLink = document.getElementById('budget-link');
  const vegetarianLink = document.getElementById('vegetarian-link');

  const recipesContainer = document.getElementById('recipes-container');
  const dessertContainer = document.getElementById('dessert-container');
  const budgetContainer = document.getElementById('budget-container');
  const vegetarianContainer = document.getElementById('vegetarian-container');

  // Function to hide all category containers
  function hideAllCategoryContainers() {
    recipesContainer.style.display = 'none';
    dessertContainer.style.display = 'none';
    budgetContainer.style.display = 'none';
    vegetarianContainer.style.display = 'none';
  }

  // Click event for Recipes
  recipesLink.addEventListener('click', function (e) {
    e.preventDefault();
    hideAllCategoryContainers();
    recipesContainer.style.display = 'block';
  });

  // Click event for Dessert
  dessertLink.addEventListener('click', function (e) {
    e.preventDefault();
    hideAllCategoryContainers();
    dessertContainer.style.display = 'block';
  });

  // Click event for Budget-Friendly Meals
  budgetLink.addEventListener('click', function (e) {
    e.preventDefault();
    hideAllCategoryContainers();
    budgetContainer.style.display = 'block';
  });

  // Click event for Vegetarian
  vegetarianLink.addEventListener('click', function (e) {
    e.preventDefault();
    hideAllCategoryContainers();
    vegetarianContainer.style.display = 'block';
  });
});

// script.js

//   form is submitted
document.getElementById('signup-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission behavior

  // form validation or submission logic
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  console.log('Username:', username);
  console.log('Password:', password);

  // reset the form after submission
  this.reset();

  // Optionally, hide the sign-up section after submission
  // document.getElementById('signup').style.display = 'none';
});


