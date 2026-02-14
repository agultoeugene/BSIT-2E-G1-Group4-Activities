const form = document.getElementById("taskForm");
const taskList = document.getElementById("taskList");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const taskName = document.getElementById("taskName").value;
  const taskDesc = document.getElementById("taskDesc").value;
  const dueDate = document.getElementById("dueDate").value;
  const priority = document.getElementById("priority").value;

  const err = document.getElementById("err");
  err.innerText = "";

  if (taskName === "") {
    err.innerText = "Please fill the task Name!";
    return false;
  }
  if (taskDesc === "") {
    err.innerText = "Please fill the task description!";
    return false;
  }

  var today = new Date();
  today.setHours(0, 0, 0, 0);

  var inputDate = new Date(dueDate);
  inputDate.setHours(0, 0, 0, 0);

  if (inputDate < today) {
    err.innerText = "Due date cannot be in the past!";
    return false;
  }

  addTask(taskName, taskDesc, dueDate, priority);
  form.reset();
});

function addTask(name, desc, date, priority) {
  let row = document.createElement("tr");

  let badgeColor =
    priority === "High"
      ? "danger"
      : priority === "Medium"
        ? "warning"
        : "success";

  row.innerHTML = `
  <td>${name}</td>
  <td>${desc}</td>
  <td>${date}</td>
  <td><span class="badge bg-${badgeColor}">${priority}</span></td>
  <td><span class="status-text">Pending</span></td>
  <td>
    <button class="btn btn-sm btn-success" onclick="toggleComplete(this)">
      Done
    </button>
    <button class="btn btn-sm btn-primary" onclick="editTask(this)">
      Edit
    </button>
    <button class="btn btn-sm btn-danger" onclick="deleteTask(this)">
      Delete
    </button>
  </td>
`;

  taskList.appendChild(row);
}

function deleteTask(btn) {
  if (confirm("Are you sure?")) {
    btn.closest("tr").remove();
  }
}

function editTask(btn) {
  let row = btn.closest("tr");

  let name = row.children[0].textContent.trim();
  let desc = row.children[1].textContent.trim();
  let date = row.children[2].textContent.trim();
  let priority = row.children[3].textContent.trim();
  let status = row.children[4].textContent.trim();

  row.children[0].innerHTML = `<input type="text" class="form-control" value="${name}">`;

  row.children[1].innerHTML = `<input type="text" class="form-control" value="${desc}">`;

  row.children[2].innerHTML = `<input type="date" class="form-control" value="${date}">`;

  row.children[3].innerHTML = `
    <select class="form-select form-select-sm">
      <option value="High" ${priority === "High" ? "selected" : ""}>High</option>
      <option value="Medium" ${priority === "Medium" ? "selected" : ""}>Medium</option>
      <option value="Low" ${priority === "Low" ? "selected" : ""}>Low</option>
    </select>
  `;

  row.children[4].innerHTML = `
    <select class="form-select form-select-sm">
      <option value="Pending" ${status === "Pending" ? "selected" : ""}>Pending</option>
      <option value="Completed" ${status === "Completed" ? "selected" : ""}>Completed</option>
    </select>
  `;

  btn.innerText = "Save";
  btn.classList.replace("btn-primary", "btn-success");

  btn.onclick = function () {
    saveTask(btn);
  };
}

function saveTask(btn) {
  let row = btn.closest("tr");

  let newName = row.children[0].querySelector("input").value.trim();
  let newDesc = row.children[1].querySelector("input").value.trim();
  let newDate = row.children[2].querySelector("input").value;
  let newPriority = row.children[3].querySelector("select").value;
  let newStatus = row.children[4].querySelector("select").value;

  if (newName === "" || newDesc === "" || newDate === "") {
    alert("All fields are required!");
    return;
  }

  let today = new Date();
  today.setHours(0, 0, 0, 0);

  let inputDate = new Date(newDate);
  inputDate.setHours(0, 0, 0, 0);

  if (inputDate < today) {
    alert("Due date cannot be in the past!");
    return;
  }

  let badgeColor =
    newPriority === "High"
      ? "danger"
      : newPriority === "Medium"
        ? "warning"
        : "success";

  row.children[0].innerHTML = newName;
  row.children[1].innerHTML = newDesc;
  row.children[2].innerHTML = newDate;
  row.children[3].innerHTML = `<span class="badge bg-${badgeColor}">${newPriority}</span>`;
  row.children[4].innerHTML = `<span class="status-text">${newStatus}</span>`;

  if (newStatus === "Completed") {
    row.classList.add("completed");
  } else {
    row.classList.remove("completed");
  }

  btn.innerText = "Edit";
  btn.classList.replace("btn-success", "btn-primary");

  btn.onclick = function () {
    editTask(btn);
  };
}

function toggleComplete(btn) {
  let row = btn.closest("tr");
  let statusCell = row.children[4];
  let currentStatus = statusCell.textContent.trim();

  if (currentStatus === "Pending") {
    statusCell.innerHTML = `<span class="status-text">Completed</span>`;
    row.classList.add("completed");

    btn.classList.remove("btn-success");
    btn.classList.add("btn-warning");
    btn.innerText = "Undo"; // Undo icon
  } else {
    statusCell.innerHTML = `<span class="status-text">Pending</span>`;
    row.classList.remove("completed");

    btn.classList.remove("btn-warning");
    btn.classList.add("btn-success");
    btn.innerText = "Done";
  }
}
