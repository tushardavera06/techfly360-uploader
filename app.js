// Sidebar toggle (mobile)
document.addEventListener("DOMContentLoaded",()=>{
  const btn = document.createElement("div");
  btn.className = "menu-btn";
  btn.innerText = "☰";
  document.body.appendChild(btn);

  const sidebar = document.querySelector(".sidebar");

  btn.onclick = ()=>{
    sidebar.classList.toggle("active");
  };

  // Close sidebar on link click (mobile)
  document.querySelectorAll(".sidebar a").forEach(link=>{
    link.onclick = ()=>{
      sidebar.classList.remove("active");
    }
  });
});

// Upload
document.getElementById("uploadForm")?.addEventListener("submit",function(e){
e.preventDefault();

let formData = new FormData(this);
let xhr = new XMLHttpRequest();

xhr.open("POST","upload.php",true);

xhr.upload.onprogress = e=>{
if(e.lengthComputable){
let p = Math.round((e.loaded/e.total)*100);
document.getElementById("bar").style.width = p+"%";
document.getElementById("percent").innerText = p+"%";
}
};

xhr.onload = ()=>{
if(xhr.status==200){
alert("Upload successful");
location.reload();
}else{
alert("Upload failed");
}
};

xhr.send(formData);
});