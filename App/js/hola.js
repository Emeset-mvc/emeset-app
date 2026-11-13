import dayjs from "dayjs";
import "dayjs/locale/ca";

export default function hola() {
    const message = document.getElementById("missatge");

    if (message) {
        message.textContent = `Avui és ${dayjs().locale("ca").format("dddd, D MMMM YYYY")}.`;
    }
}

function add(a, b) {
  return a + b;
}

function resta(a, b) {
  return a - b;
}

export {add, resta};
