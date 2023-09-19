<script>
$(document).ready(function () {
  // Quando o botão for clicado
  $("#botaoSair").click(function () {
    // Realiza uma solicitação AJAX para a ação "logout"
    $.ajax({
      url: "LoginController.php", // URL do seu controlador PHP
      type: "POST",
      data: { action: "sair" }, // Chama a ação "logout"
      success: function () {
      a
        window.location.href = "login.php"; 
      },
      error: function () {
        // Ocorreu um erro ao chamar a ação "logout"
        console.error("Erro ao efetuar logout.");
      },
    });
  });
});
</script>
