



document.getElementById('add-button').addEventListener('click',function () {

    if (document.getElementById('text-input').value.length > 0) {
        let textInput = document.getElementById('text-input').value;

        const li = document.createElement('li');
        const done = document.createElement('button');
        const del = document.createElement('button');

        done.innerText = 'Mark as done'
        del.innerText = 'Delete'

        done.classList.add('done');
        del.classList.add('delete')
        li.innerHTML = textInput;
        li.append(del);
        li.append(done);

        document.getElementById('todo-ul').append(li);

    }
    document.getElementById('text-input').value = '';


})

$(document).on('click','.done',function (event) {
    event.preventDefault();
    $(this).parent().css('color','#32CD32')
    $(this).hide();
})

$(document).on('click','.delete',function (event) {
    event.preventDefault();
    $(this).parent().remove();

})