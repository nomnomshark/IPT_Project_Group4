// JavaScript to Populate Modals

var viewStudentModal = document.getElementById('viewStudentModal');
viewStudentModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var firstname = button.getAttribute('data-firstname');
    var lastname = button.getAttribute('data-lastname');
    var middlename = button.getAttribute('data-middlename');
    var suffix = button.getAttribute('data-suffix');
    var age = button.getAttribute('data-age');
    var program = button.getAttribute('data-program');
    var year = button.getAttribute('data-year');

    document.getElementById('view-id').textContent = id;
    document.getElementById('view-firstname').textContent = firstname;
    document.getElementById('view-lastname').textContent = lastname;
    document.getElementById('view-middlename').textContent = middlename;
    document.getElementById('view-suffix').textContent = suffix;
    document.getElementById('view-age').textContent = age;
    document.getElementById('view-program').textContent = program;
    document.getElementById('view-year').textContent = year;
});

var editStudentModal = document.getElementById('editStudentModal');
editStudentModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var firstname = button.getAttribute('data-firstname');
    var lastname = button.getAttribute('data-lastname');
    var middlename = button.getAttribute('data-middlename');
    var suffix = button.getAttribute('data-suffix');
    var age = button.getAttribute('data-age');
    var program = button.getAttribute('data-program');
    var year = button.getAttribute('data-year');

    document.getElementById('edit-id').value = id;
    document.getElementById('edit-firstname').value = firstname;
    document.getElementById('edit-lastname').value = lastname;
    document.getElementById('edit-middlename').value = middlename;
    document.getElementById('edit-suffix').value = suffix;
    document.getElementById('edit-age').value = age;
    document.getElementById('edit-program').value = program;
    document.getElementById('edit-year').value = year;
});

var deleteStudentModal = document.getElementById('deleteStudentModal');
deleteStudentModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    document.getElementById('delete-id').value = id;
});
