var tar;
var today = new Date();
var showy = today.getFullYear();
var showm = today.getMonth() + 1;
var year = new Array();
var month = new Array();
var day = new Array();
var evnt = new Array();
var mond = new Array();

function $(id){
  return document.getElementById(id);
}

function updshow(showy,showm){
  var i, mnd, shw, shd;
  var dow = -1;
  var enm = -1;
  for(i = 0; i < mond.length; i++){
    mnd = mond[i].split(':');
    if(parseInt(mnd[0]) == parseInt(showy)){
      if(parseInt(mnd[1]) == parseInt(showm)){
        dow = parseInt(mnd[2]);
        enm = parseInt(mnd[3]);
        break;
      }
    }
  }
  if(dow == -1){
    alert("data is not exist.");
    return;
  }else{
    shd = dow;
    shw = 1;
  }
  for(i = 0; i < dow; i++){
    tar.rows[1].cells[i].innerHTML = "";
  }
  for(i = 0; i < 7; i++){
    tar.rows[5].cells[i].innerHTML = "";
  }
  for(i = 0; i < 7; i++){
    tar.rows[6].cells[i].innerHTML = "";
  }
  for(i = 0; i < enm; i++){
    if(shd > 6){
      shd = 0;
      shw++;
    }
    tar.rows[shw].cells[shd].innerHTML = (i + 1) + '\n';
    shd++;
  }
  for(i = 0; i < year.length; i++){
    if(parseInt(year[i]) == parseInt(showy)){
      if(parseInt(month[i]) == parseInt(showm)){
        shd = dow + day[i] - 1;
        shw = 1;
        while(shd > 6){
          shd = shd - 7;
          shw++;
        }
        tar.rows[shw].cells[shd].innerHTML = tar.rows[shw].cells[shd].innerHTML + '\n' + evnt[i];
      }
    }
  }
  return;
}

function leapyear(y){
  if(y % 400 == 0){
    return 1;
  }
  if(y % 100 == 0){
    return 0;
  }
  if(y % 4 == 0){
    return 1
  }
  return 0;
}

function init(){
  var i, j, insr, mktn;
  var d = 6;
  tar = $("tab");
  for(i = 2022; i < 2025; i++){
    for(j = 1; j <= 12; j++){
      switch(j){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
          mond.push(i + ":" + j + ":" + d + ":31");
          d = (d + 31) % 7;
          break;
        case 4:
        case 6:
        case 9:
        case 11:
          mond.push(i + ":" + j + ":" + d + ":30");
          d = (d + 30) % 7;
          break;
        case 2:
          if(leapyear(i)){
            mond.push(i + ":" + j + ":" + d + ":29");
            d = (d + 29) % 7;
          }else{
            mond.push(i + ":" + j + ":" + d + ":28");
            d = (d + 28) % 7;
          }
          break;
      }
    }
  } 
  for(i = 0; i < 6; i++){
    insr = tar.tBodies[0].insertRow(-1);
    for(j = 0; j < 7; j++){
      insr.insertCell(-1).appendChild(document.createTextNode(""));
    }
  }
  updshow(showy,showm);
  return;
}

