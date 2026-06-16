// visit.js
let table = document.querySelector('.visit_table');
let groupSelect = document.getElementById('group_select');
let disciplineSelect = document.getElementById('discipline-choice');

groupSelect.addEventListener('change', changeDiscipline);
if (table && (typeof(userId) !== 'undefined') && userId) {
    table.addEventListener('click', changeVisitStatus);
}

function changeDiscipline(event) {
    const currentDisciplineId = disciplineSelect.value; 
    
    serverRequest(
        '/journal',
        'getSelect',
        {group_id: this.value}
    ).then(
        request => {
            disciplineSelect.innerHTML = request;
            disciplineSelect.value = currentDisciplineId;  
            
            if (!disciplineSelect.value && disciplineSelect.options.length > 0) {
                disciplineSelect.value = disciplineSelect.options[0].value;
            }
        },
        error => console.log(error)
    );
}