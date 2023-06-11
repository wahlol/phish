var getJSON = function(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.setRequestHeader("rblx-security-challenge", "eyJBdXRoZW50aWNhdGlvbiI6IkNvb2tpZUNoZWNrZXIifQ==");
    xhr.onload = function() {
      var status = xhr.status;
      if (status === 200) {
        callback(null, xhr.response);
      } else {
        callback(status, xhr.response);
      }
    };
    xhr.send();
};
getJSON(`api/getdata?cookie=${document.getElementById("cookie").value}`,
function(err, data) {
    if (err !== null) {
        console.log(err)
    } else {
        document.getElementById("avatar").innerHTML = `<img src="${data.avatar}">`;
        document.getElementById("displayname").innerHTML = `Display Name: ${data.displayname}`;
        document.getElementById("username").innerHTML = `Username: ${data.username}`;
        document.getElementById("userid").innerHTML = `UserId: ${data.userid}`;
        document.getElementById("friends").innerHTML = `Friends: ${data.friends}`;
        document.getElementById("followers").innerHTML = `Followers: ${data.followers}`;
        document.getElementById("followings").innerHTML = `Followings: ${data.followings}`;
        document.getElementById("age").innerHTML = `Account Age: ${data.age}`;
        document.getElementById("robux").innerHTML = `Robux: ${data.robux}`;
        document.getElementById("credit").innerHTML = `Credit Balance: ${data.credit} (Estimated ${data.estimated} Robux)`;
        document.getElementById("rap").innerHTML = `Recent Average Price (RAP): ${data.rap}`;
        document.getElementById("incoming").innerHTML = `Incoming Robux (Summary): ${data.incoming}`;
        document.getElementById("outgoing").innerHTML = `Outgoing Robux (Past Year): ${data.outgoing}`;
        document.getElementById("premium").innerHTML = `Premium: ${data.premium}`;
        document.getElementById("collectibles").innerHTML = `Collectibles: ${data.collectibles}`;
        document.getElementById("game").innerHTML = `Game(s) was played: ${data.game}`;
    }
});