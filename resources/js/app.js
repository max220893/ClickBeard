require("./bootstrap");

import Alpine from "alpinejs";
import axios from "axios";
import $ from "jquery";

window.$ = window.jQuery = $;

window.Alpine = Alpine;

Alpine.start();

$(document).on("change", "#especialidade", (e) => {
    e.preventDefault();
    let data = $("#data").val();
    if (data == "") {
        alert("preencha o campo data");
        $("#especialidade").val("Selecione");
        return;
    }
    let horario = $("#horario").val();
    if (horario == "Selecione") {
        alert("preencha o campo Horário");
        $("#especialidade").val("Selecione");
        return;
    }
    let especialidade = $("#especialidade").val();
    if (especialidade == "Selecione") {
        alert("preencha o campo Especialidade");
        return;
    }
    let dados = { data: data, horario: horario, especialidade: especialidade };
    axios
        .get(`${APP_URL}/agendamentos/barbeiro-disponivel`, { params: dados })
        .then(({ data }) => {
            console.log(data);
            $("#barbeiro").empty();
            const htmlBarbeiros = data
                .map((barbeiro) => {
                    const { id, nome } = barbeiro;
                    return `<option value="${id}">${nome}</option>`;
                })
                .reduce((current, accumulated) => {
                    accumulated += current;
                    return accumulated;
                }, "");
            if (data.length == 0) {
                $("#barbeiro").append(
                    '<option value="">Não há barbeiros disponíveis</option>'
                );
            } else {
                $("#barbeiro").append(htmlBarbeiros);
            }
        })
        .catch(({ response }) => {
            const { data } = response;
            alert(data.message);
        });
});

$(document).on("change", "#data", (e) => {
    $("#especialidade").trigger("change");
});
$(document).on("change", "#horario", (e) => {
    $("#especialidade").trigger("change");
});
