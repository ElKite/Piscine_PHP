function init() 
  {
      var list = document.getElementById('ft_list');
      var newToDo = document.getElementById('new');
      var newToDoTxt;
    
      retrieveDataFromCookie(list);
    
      newToDo.onclick = function () {
        newToDoTxt = prompt("Renseigner le nouveau To Do");
        if (newToDoTxt != null)
          AddAnotherToDo();
    };
     
    function AddAnotherToDo()
    {
      var todo = document.createElement("div");
      if (newToDoTxt){
      todo.appendChild(document.createTextNode(newToDoTxt));
      }
      list.insertBefore(todo, list.firstChild);
      todo.addEventListener("click", function(del){
        var ok = confirm("Supprimer ?");
        if (ok)
          {
            list.removeChild(del.target);
            saveCookie();
          }
      });
    };
    
    function saveCookie()
    {
      var todos = [];
      for(var i = 0; i < list.childNodes.length; i++) {
      todos.push(list.childNodes[i].innerHTML);
    }
    var value = todos.join("%%%");
    document.cookie = "ft_list" + "=" + value + ";expires=Thu, 18 Dec 2016 12:00:00 UTC";
    }
    
    function getCookie()
    {
      var dc = document.cookie.split(";");
    for(var i = 0; i < dc.length; i++) {
      var value = dc[i].split("=");
      if (value[0] === "ft_list")
        return value[1];
    }
    return null;
    }
    
    function retrieveDataFromCookie(list)
    {
      var cookie = getCookie();
      var listt = document.getElementById("ft_list");
      if (cookie != null) {
        var tab = cookie.split("%%%");
          for(var i = 0; i < tab.length; i++) {
              var todo = document.createElement("div");
              todo.innerHTML = tab[i];
              todo.addEventListener("click", function(del) {
                  var ok = confirm("Supprimer !?");
                  if (ok) {
                      listt.removeChild(del.target);
                      saveCookie();
                  }
              });
              listt.appendChild(todo);
          }
    }
      AddAnotherToDo();
    };
}