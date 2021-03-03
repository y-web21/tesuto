function insertFormMethod(event){
    event.currentTarget.insertAdjacentHTML('beforebegin',this.method)
}

const patch = '<input type="hidden" name="_method" value="patch">'
const post = '<input type="hidden" name="_method" value="post">'

const button = document.getElementById('btn_edit_confirm');
button.addEventListener('click', {handleEvent: insertFormMethod, method:patch});
const button2 = document.getElementById('btn_edit_image_select');
button2.addEventListener('click', {handleEvent: insertFormMethod, method:post});
