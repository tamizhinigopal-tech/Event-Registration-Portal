// Smooth Scroll
function scrollToForm() {
    document.getElementById("register").scrollIntoView({
        behavior: "smooth"
    });
}

// Load participants when page opens
window.onload = function () {
    loadParticipants();
};

// Registration Form
document.getElementById("registrationForm").addEventListener("submit", function (e) {

    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const event = document.getElementById("event").value;

    if (!name || !email || !event) {
        document.getElementById("message").innerHTML = "❌ Please fill all fields.";
        return;
    }

    const participants = JSON.parse(localStorage.getItem("participants")) || [];

    participants.push({
        id: Date.now(),
        name,
        email,
        event
    });

    localStorage.setItem("participants", JSON.stringify(participants));

    loadParticipants();

    document.getElementById("registrationForm").reset();

    document.getElementById("message").innerHTML =
        "✅ Registration Successful!";

    setTimeout(() => {
        document.getElementById("message").innerHTML = "";
    }, 3000);
});

// Load Participants
function loadParticipants() {

    const participants =
        JSON.parse(localStorage.getItem("participants")) || [];

    const table =
        document.getElementById("participantList");

    table.innerHTML = "";

    participants.forEach((p) => {

        table.innerHTML += `
        <tr>
            <td>${p.name}</td>
            <td>${p.email}</td>
            <td>${p.event}</td>
            <td>
                <button
                    class="delete-btn"
                    onclick="deleteParticipant(${p.id})">
                    Delete
                </button>
            </td>
        </tr>
        `;

    });

}

// Delete Participant
function deleteParticipant(id) {

    let participants =
        JSON.parse(localStorage.getItem("participants")) || [];

    participants =
        participants.filter(p => p.id !== id);

    localStorage.setItem("participants",
        JSON.stringify(participants));

    loadParticipants();

}

// Search
function searchParticipants() {

    const input =
        document.getElementById("searchInput")
        .value
        .toLowerCase();

    const participants =
        JSON.parse(localStorage.getItem("participants")) || [];

    const filtered =
        participants.filter(p =>
            p.name.toLowerCase().includes(input)
        );

    const table =
        document.getElementById("participantList");

    table.innerHTML = "";

    filtered.forEach((p) => {

        table.innerHTML += `
        <tr>
            <td>${p.name}</td>
            <td>${p.email}</td>
            <td>${p.event}</td>
            <td>
                <button
                    class="delete-btn"
                    onclick="deleteParticipant(${p.id})">
                    Delete
                </button>
            </td>
        </tr>
        `;

    });

}

// Countdown Timer
const countDownDate =
    new Date("December 31, 2026 09:00:00").getTime();

setInterval(function () {

    const now = new Date().getTime();

    const distance =
        countDownDate - now;

    if (distance < 0) {

        document.getElementById("timer").innerHTML =
            "🎉 Event Started!";

        return;
    }

    const days =
        Math.floor(distance / (1000 * 60 * 60 * 24));

    const hours =
        Math.floor((distance % (1000 * 60 * 60 * 24))
            / (1000 * 60 * 60));

    const minutes =
        Math.floor((distance % (1000 * 60 * 60))
            / (1000 * 60));

    const seconds =
        Math.floor((distance % (1000 * 60))
            / 1000);

    document.getElementById("timer").innerHTML =
        `${days}d ${hours}h ${minutes}m ${seconds}s`;

}, 1000);