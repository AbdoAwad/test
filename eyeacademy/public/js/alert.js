var tabItem = document.querySelectorAll(".row .collection-item");
var tabcontent = document.querySelectorAll(".tab-content");


function showContent(contentIndex, colorCode, textColor) {
    tabItem.forEach(function (node) {
        node.style.backgroundColor = "";
        node.style.color = "";
    });
    
    tabItem[contentIndex].style.backgroundColor = colorCode;
    tabItem[contentIndex].style.color = textColor;
    
    tabcontent.forEach(function (node) {
        node.style.display = "none";
    });
    
    tabcontent[contentIndex].style.display = "block";
}

function deleteItem() {
    swal({
      title: "Are you sure?",
      text: "Once item delet, you will not be able to recover this item!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Poof! Your item has been deleted!", {
          icon: "success",
        });
      } else {
        swal("Your item is safe!");
      }
    });

}

function rejectRequest() {
    swal({
      title: "Are you sure?",
      text: "Once regict request, you will not be able to recover this request!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Poof! Your request has been rejected!", {
          icon: "success",
        });
      } else {
        swal("Your requist is safe!");
      }
    });

}

function acceptRequest(){
    swal("Request is accepted!", "Notification will send to user", "success");
}
function sendRequest(){
    swal("Request is sent!", "Notification will send to user", "success");
}

function uploadItem(){
    swal("Item is uploaded!", "Media will checke then appear to user", "success");
}

function checkAvilabilitItem(){
    swal("Item is Sent!", "Notification will send after check", "success");
}

