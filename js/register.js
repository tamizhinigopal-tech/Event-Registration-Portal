// ===============================
// College Event Registration Portal
// register.js
// ===============================

document.getElementById("registrationForm").addEventListener("submit", registerStudent);

function registerStudent(e) {

    e.preventDefault();

    // Get form values
    const name = document.getElementById("name").value.trim();
    const studentId = document.getElementById("studentId").value.trim();
    const department = document.getElementById("department").value.trim();
    const year = document.getElementById("year").value;
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const event = document.getElementById("event").value;

    const message = document.getElementById("message");

    // Validation
    if (
        name === "" ||
        studentId === "" ||
        department === "" ||
        year === "" ||
        email === "" ||
        phone === "" ||
        event === ""
    ) {
        message.style.color = "red";
        message.innerHTML = "❌ Please fill in all fields.";
        return;
    }

    // Load existing registrations
    let registrations = JSON.parse(localStorage.getItem("registrations")) || [];

    // Check duplicate Student ID
    const exists = registrations.some(student => student.studentId === studentId);

    if (exists) {
        message.style.color = "red";
        message.innerHTML = "❌ Student ID already registered!";
        return;
    }

    // Generate Registration ID
    const registrationId = "REG" + (1001 + registrations.length);

    // Create student object
    const student = {
        registrationId,
        name,
        studentId,
        department,
        year,
        email,
        phone,
        event,
        status: "Pending",
        registrationDate: new Date().toLocaleDateString()
    };

    // Save
    registrations.push(student);

    localStorage.setItem("registrations", JSON.stringify(registrations));

    // Save logged-in student (for dashboard)
    localStorage.setItem("currentUser", JSON.stringify(student));

    message.style.color = "green";
    message.innerHTML = "✅ Registration Successful!";

    document.getElementById("registrationForm").reset();

    // Redirect after 2 seconds
    setTimeout(function () {
        window.location.href = "dashboard.html";
    }, 2000);

}