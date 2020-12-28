function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function validate() {
  const pass = document.getElementById("pass");
  const conf = document.getElementById("confirm_pass");
  const signup = document.getElementById("signup");

  if (pass.value === conf.value && pass.value !== "") {
    pass.style.border = "none";
    signup.disabled = false;
  } else {
    pass.style.border = "1px solid red";
    signup.disabled = true;
  }
}

function validate_date() {
  const from = document.getElementById("starts").value;
  const to = document.getElementById("ends").value;
  const btn = document.getElementById("create");

  console.log(from);
  console.log(to);

  const splitFrom = from.split("/");
  const splitTo = to.split("/");

  const fromDate = Date.parse(splitFrom[0], splitFrom[1] - 1, splitFrom[2]);
  const toDate = Date.parse(splitTo[0], splitTo[1] - 1, splitTo[2]);

  console.log(fromDate);
  console.log(toDate);

  btn.disabled = fromDate >= toDate;
}

const host = window.location.host;

function update_values(url) {
    const request = async () => {
        const json = await fetch(url).then(response => response.json());
        for (const k in json) {
            if (json.hasOwnProperty(k) && document.getElementById(k) !== null) {
                document.getElementById(k).value = json[k];
            }
        }
    }
    return request(url);
}