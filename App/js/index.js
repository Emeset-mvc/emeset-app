import $ from "jquery";

import hola from "./hola.js";

import {Example, obj} from "./example.ts";

$(function() {
    console.log('Hello World');
    hola();
    console.log($("#mapa").data("location"));
    let locations = $("#mapa").data("location");
    console.log(locations);
    $("body").on("click", f);
    console.log("Example", obj);
});

function f() {
    console.log('f');
}



//window.f = f;
