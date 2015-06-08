var mysql = require('mysql');
var fs = require('fs');

var dbConnInfo = {
'host'           : '127.0.0.1',
'database'     : 'mwork_db',
'port'           : 3306,
'user'           : 'root',
'password'     : 'root'
}

var client = mysql.createConnection(dbConnInfo);

client.connect();

var fileList = scanFolder('./json').files;

for(var i in fileList){
    saveData(fileList[i]);
}


function saveData(f)
{
  var defaultAuthUserId = 1;
  var jsonData = require(f);
  var candidateData = {
    englishname:jsonData.EnglishName[0],
    chinesename:jsonData.ChineseName[0],
    gender:jsonData.Gender[0],
    maritalstatus:jsonData.MaterialStatus[0],
    location:jsonData.Location[0],
    city:'',
    status:jsonData.Status[0],
    label:jsonData.Lable[0],
    mobile1:jsonData.Mobile[0],
    mobile2:'',
    tel:'',
    resumes:'',
    cvsite:'',
    cvNO:'',
    cvPath:'',
    QQ:'',
    wechat:'',
    notes:'',
    company:jsonData.Company[0], // need insert...
    position:jsonData.Title[0], // need insert...
    hometown:jsonData.HomeTown[0],
    email:jsonData.Email[0],
    creater_id:defaultAuthUserId,
    birthday:'',
  };

  
  var stext = '';
  for(var i in candidateData){
    if(candidateData[i] === null || candidateData[i] === undefined){
      candidateData[i] = '';
    }
    stext = stext + ' ' + candidateData[i];
  }
  candidateData.searchtext = stext;

  var commentData = [];
  for(var i in jsonData.Comments){
    var d = {
      auth_id:defaultAuthUserId,  // by admin
      created_at:jsonData.CommentsTime[i],
      cvPath:jsonData.Resumes[i],
      content:jsonData.Comments[i]
      };
      commentData.push(d);
  }

  client.query(  
    'INSERT INTO Candidates SET ?',candidateData,  
    function (err, result) {  
      if (!err) {  
        // add comment and move resume to path
        for(var i in commentData ){
          var d = commentData[i];
          console.log(arguments);

          d['ca_id'] = result.insertId;
          d['proj_id'] = 0;
          // insert comments
          client.query(  
            'INSERT INTO Cacomments SET ?', d,  
            function (err2, result2) {
              if(!!err2){
                console.log(err2);
              }
            });
        }  
    } 
    else{
          console.log(err);
        }
  }); 

  //client.end();  
}

function scanFolder(path){
    var fileList = [],
        folderList = [],
        walk = function(path, fileList, folderList){
            files = fs.readdirSync(path);
            files.forEach(function(item) {  
                var tmpPath = path + '/' + item,
                    stats = fs.statSync(tmpPath);

                if (stats.isDirectory()) {  
                    walk(tmpPath, fileList, folderList); 
                    folderList.push(tmpPath); 
                } else {  
                    fileList.push(tmpPath); 
                }  
            });  
        };  

    walk(path, fileList, folderList);

    console.log('扫描' + path +'成功');

    return {
        'files': fileList,
        'folders': folderList
    }
}