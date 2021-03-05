function insertFormMethod(event) {
    event.currentTarget.insertAdjacentHTML('beforebegin', this.method)
}
function addRequired() {
    for (let index = 0; index < this.target.length; index++) {
        if (document.getElementById(this.target[index]) != null) {
            document.getElementById(this.target[index]).setAttribute("required", true);
        }
    }
}
function removeRequired() {
    for (let index = 0; index < this.target.length; index++) {
        if (document.getElementById(this.target[index]) != null) {
            document.getElementById(this.target[index]).removeAttribute("required");
        }
    }
}

const patch = '<input type="hidden" name="_method" value="patch">';
const post = '<input type="hidden" name="_method" value="post">';
const required_field = ['new_title', 'new_content'];

if (document.getElementById('btn_submit_update') != null) {
    document.getElementById('btn_submit_update').addEventListener('click', { handleEvent: insertFormMethod, method: patch });
}
if (document.getElementById('btn_edit_image_select') != null) {
    document.getElementById('btn_edit_image_select').addEventListener('click', { handleEvent: insertFormMethod, method: post });
}

if (document.getElementById('btn_submit_new_post') != null) {
    document.getElementById('btn_submit_new_post').addEventListener('click', { handleEvent: addRequired, target: required_field });
}
if (document.getElementById('btn_submit_update') != null) {
    document.getElementById('btn_submit_update').addEventListener('click', { handleEvent: addRequired, target: required_field });
}
if (document.getElementById('btn_submit_select_image') != null) {
    document.getElementById('btn_submit_select_image').addEventListener('click', { handleEvent: removeRequired, target: required_field });
}
