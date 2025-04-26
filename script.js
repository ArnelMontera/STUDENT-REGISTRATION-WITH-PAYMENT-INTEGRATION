// script.js
const subjects = {
    BSMA: ["Math 101", "Statistics", "Accounting Basics"],
    BSA: ["Financial Accounting", "Auditing", "Taxation"],
    BSIS: ["Info Systems", "Database Management", "System Analysis"],
    BSIT: ["Programming 101", "Networking", "Web Development"]
};

const courseSelect = document.getElementById("course");
const subjectSelect = document.getElementById("subject");

courseSelect.addEventListener("change", function () {
    const selectedCourse = this.value;
    subjectSelect.innerHTML = ""; // Clear previous options

    if (subjects[selectedCourse]) {
        subjectSelect.innerHTML = `<option value="">Select a subject</option>`;
        subjects[selectedCourse].forEach(sub => {
            const opt = document.createElement("option");
            opt.value = sub;
            opt.textContent = sub;
            subjectSelect.appendChild(opt);
        });
    } else {
        subjectSelect.innerHTML = `<option value="">Please select a course first</option>`;
    }
});
