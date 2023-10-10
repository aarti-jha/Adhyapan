
document.getElementById("logoutButton").addEventListener("click", function() {
  // Create a new XMLHttpRequest or use the fetch API for modern browsers
  var xhr = new XMLHttpRequest();

  // Define the HTTP method and the URL of the PHP script
  xhr.open("GET", "logout.php", true);

  // Set up an event listener to handle the response from the server
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // The request was successful, and you can handle the response here if needed
      // For a logout action, you might want to redirect the user to a login page
      window.location.href = "afterjoinus.html";
    }
  };

  // Send the HTTP request
  xhr.send();
});

