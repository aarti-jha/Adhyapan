// This is a mock user object. In a real application, you would get this information from your server.
const user = {
    name: "John Doe",
    role: "Student",
    email: "john.doe@example.com",
    address: "123 Main St, Cityville"
};

// Function to set user information on the dashboard
function setUserInfo() {
    document.getElementById("user-name").textContent = user.name;
    document.getElementById("user-role").textContent = user.role;
    document.getElementById("user-email").textContent = user.email;
    document.getElementById("user-address").textContent = user.address;
}

// Function to handle logout
function logout() {
    // Perform logout actions, e.g., redirect to the logout endpoint, clear session, etc.
    // For simplicity, let's just reload the page in this example.
    location.reload();
}

// Set user information when the page loads
window.onload = setUserInfo;
