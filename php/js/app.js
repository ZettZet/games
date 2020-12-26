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

    const splitFrom = from.split('/');
    const splitTo = to.split('/');

    const fromDate = Date.parse(splitFrom[0], splitFrom[1] - 1, splitFrom[2]);
    const toDate = Date.parse(splitTo[0], splitTo[1] - 1, splitTo[2]);

    console.log(fromDate);
    console.log(toDate);

    if (fromDate < toDate) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

function update_categories(id) {
    const td_toChange = document.getElementById(`categories_${id}`);
    const new_input = document.createElement('input');
    new_input.type = "text";
    new_input.id = id;
    new_input.value = td_toChange.textContent || td_toChange.innerText;

    const save = td_toChange.textContent;
    td_toChange.textContent = "";
    td_toChange.appendChild(new_input);

    new_input.addEventListener('keydown', function (ev) {
        if (ev.code === 'Enter') {
            if (this.value !== "") {
                const response = fetch('/update_category.php',
                    {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json'
                        },
                        body: `UPDATE category SET name='${this.value}' WHERE id=${this.id};`
                    })
                    .then((resp) => {
                        return resp.json()
                    })
                    .then((value) => {
                        return JSON.parse(value);
                    })
                    .then(value => {
                        if (value === true) {
                            td_toChange.textContent = this.value;
                            alert('Успешно')
                        } else {
                            td_toChange.textContent = save;
                            alert('Первышен максимальный размер имени категории')
                        }
                        td_toChange.removeChild(new_input);
                    });
            } else {
                if (confirm(`Вы дейстительно хотите удалить ${this.value}?`)) {
                    const response = fetch('/update_category.php',
                        {
                            method: 'DELETE',
                            headers: {
                                'Content-type': 'application/json'
                            },
                            body: `DELETE FROM category WHERE id=${this.id};`
                        })
                        .then((resp) => {
                            return resp.json()
                        })
                        .then((data) => {
                            return JSON.parse(data);
                        })
                        .then((value) => {
                            if (value === true) {
                                const tr = td_toChange.parentElement;
                                const table = tr.parentElement;

                                table.removeChild(tr);
                                alert('Успешно')
                            } else {
                                alert('Что-то пошло не так');
                            }
                        });
                }
            }
        }
    });

}

function add_category() {
    const tr_add = document.getElementById('add_row');
    const td_add = document.getElementById('add');
    const table = document.getElementById('table').children[0];
    const new_input = document.createElement('input');

    new_input.type = "text";
    new_input.value = "";
    new_input.required = true;
    new_input.placeholder = "Название категории";
    new_input.addEventListener('keypress', function (ev) {
        if (ev.code === "Enter") {
            const response = fetch('/add_category.php',
                {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json'
                    },
                    body: `INSERT INTO category(name) VALUES ('${this.value}');`
                })
                .then(resp => {
                    return resp.json();
                })
                .then(value => {
                    return JSON.parse(value);
                })
                .then(value => {
                    if (value !== false) {
                        td_add.colSpan = "1";
                        td_add.textContent = value;
                        const new_td = document.createElement('td');
                        new_td.id = `categories_${value}`;
                        new_td.ondblclick = () => update_categories(value);
                        new_td.textContent = new_input.value;
                        tr_add.appendChild(new_td);
                        tr_add.removeAttribute('id');
                        td_add.removeAttribute('id');

                        const new_row = table.insertRow(table.childElementCount);
                        const new_cell = new_row.insertCell(0);
                        new_row.id = "add_row";
                        new_cell.className = "add";
                        new_cell.id = "add";
                        new_cell.colSpan = 2;
                        new_cell.ondblclick = add_category;
                        new_cell.textContent = "Добавить категорию";
                    } else {
                        alert('Что-то пошло не так');
                    }
                })
        }
    });

    td_add.textContent = "";
    td_add.appendChild(new_input);
}