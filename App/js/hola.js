export default function hola() {
    console.log('hola hola');
    const message = document.getElementById("missatge");

    if (message) {
        const paragraph = document.createElement("p");
        paragraph.textContent = "Text afegit amb JavaScript.";
        message.append(paragraph);
    }
}

function add(a, b) {
  return a + b;
}

function resta(a, b) {
  return a - b;
}

export {add, resta};
