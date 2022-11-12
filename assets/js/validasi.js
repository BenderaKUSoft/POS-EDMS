
function getkey(e) {
  if (window.event)
    return window.event.keyCode;
  else if (e)
    return e.which;
  else
    return null;
}

function goodchars(e, status, field) {
  var key, keychar;
  key = getkey(e);
  if (key == null) return true;
  if (status === 'number') { goods = '0123456789.'; }
  else if (status === 'font') { goods = 'abcdefghijklmnopqrstuvwxyz ,.-'; }
  else { goods = 'abcdefghijklmnopqrstuvwxyz0123456789 ,.-'; }
  keychar = String.fromCharCode(key);
  keychar = keychar.toLowerCase();
  goods = goods.toLowerCase();
  if (goods.indexOf(keychar) != -1)
    return true;
  if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
    return true;
  if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
      if (field == field.form.elements[i]) break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
  };
  return false;
}

function relogin(m, u, k) {
  swal.fire({
    title: m, icon: "warning",
    input: 'password', inputPlaceholder: 'Enter your password',
    inputAttributes: { maxlength: 10, autocapitalize: 'off', autocorrect: 'off' },
    showCancelButton: true, confirmButtonText: "OK, Login"
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: 'POST', url: u, dataType: 'json', data: { k: k, p: result.value },
        success: function (h) {
          if(h.code == 200) location.reload(true);
          Toast.fire({ icon: h.status, title: h.message });
          return h;
        }, error: function (e) { return e; }
      });
    }
  });
}
