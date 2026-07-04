window.onload = loadAdminData;

function loadAdminData() {

    const participants =
        JSON.parse(localStorage.getItem("participants")) || [];

    document.getElementById("totalParticipants").innerHTML =
        participants.length;

    document.getElementById("pendingCount").innerHTML =
        participants.length;

    let table = "";

    participants.forEach((p, index) => {

        table += `
        <tr>

            <td>${p.name}</td>

            <td>${p.email}</td>

            <td>${p.event}</td>

            <td>Pending</td>

            <td>

                <button
                class="delete-btn"
                onclick="deleteParticipant(${index})">

                Delete

                </button>

            </td>

        </tr>
        `;

    });

    document.getElementById("adminTable").innerHTML = table;

}

function deleteParticipant(index){

    let participants =
        JSON.parse(localStorage.getItem("participants")) || [];

    participants.splice(index,1);

    localStorage.setItem(
        "participants",
        JSON.stringify(participants)
    );

    loadAdminData();

}