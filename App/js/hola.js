import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

export  default function hola() {
    console.log('hola hola');
}
console.log("Hola 2");

$("#missatge").append("<p>Text afegit amb jQuery.</p>");

function add(a, b) {
  return a + b;
}

function resta(a, b) {
  return a - b;
}

export {add, resta};
