<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!--LOGO-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">

  <title>Cadastro Endereços</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./emprestimo_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <script src="./cadastroGrupos_files/color-modes.js.transferir"></script>
  <!-- CSS do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <meta name="theme-color" content="#712cf9">

  <style>
    body {
      margin: 0;
      padding-bottom: 20px;
      height: 100%;
      overflow-y: auto;
      /* Permite a rolagem vertical na página */
      padding-bottom: 5px;
    }

    .container {
      min-height: calc(100vh - 20px);
      display: flex;
      justify-content: center;
      align-items: flex-start;
      /* Alinha o conteúdo ao topo */
      padding-bottom: 5px;
      box-sizing: border-box;
      height: 100%;
      flex-direction: column;
      overflow: visible;
      /* Permite o conteúdo transbordar se necessário */
    }

    main {
      width: 100%;
      max-width: 600px;
      padding: 15px;
      box-sizing: border-box;
    }

    .form-control {
      flex-grow: 1;
      /* Faz com que o input ocupe o máximo de espaço possível */
    }



    .table-container {
      width: 100%;
      box-sizing: border-box;
      margin-top: 30px;
      overflow-y: auto;
      /* Mantém a rolagem apenas na tabela */
      max-height: 300px;
    }

    .table-container table {
      width: 100%;
      border-collapse: collapse;
      table-layout: auto;
    }

    .table-container th,
    .table-container td {
      text-align: left;
      padding: 8px;
      border: 1px solid #dee2e6;
    }

    .search-bar {
      display: flex;
      align-items: center;
      margin-top: 20px;
      /* Espaçamento acima da barra de pesquisa */
      margin-bottom: 20px;
      /* Espaçamento abaixo da barra de pesquisa */
    }

    .search-bar .form-control {
      flex: 3;
      /* O input de pesquisa ocupará 75% do espaço */
      margin-right: 10px;
      /* Espaçamento entre o campo e o botão */
    }

    .search-bar .btn {
      flex: 1;
      /* O botão ocupará 25% do espaço */
      white-space: nowrap;
      /* Garante que o texto do botão não quebre */
    }

    .btn {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
    }

    .custom-btn {
      background-color: transparent;
      color: black;
      border-color: black;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .custom-btn:hover {
      background-color: black;
      color: white;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="./cadastroGrupos_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

</head>

<body class="bg-body-tertiary">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php" style="color:white">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="manutencao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Manutenção</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
            <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
            <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
            <!--<a class="dropdown-item" href="cadastroRequisitante.html">Requisitante</a>
              <a class="dropdown-item" href="cadastroSupervisor.html">Supervisor</a>-->
            <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
            <a class="dropdown-item" href="cadastroEnderecos.php">Endereço</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="movimentacao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Movimentação</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="devolucao.php">Devolução</a>
            <a class="dropdown-item" href="emprestimo.php">Empréstimo</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="relatorios" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Relatórios</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="relatorioMovimentacao.php">Movimentações Gerais</a>
            <a class="dropdown-item" href="inventario.php">Inventário</a>
            <a class="dropdown-item" href="relatorioEnderecos.php ">Endereços</a>
            <a class="dropdown-item" href="relatorioTopUsuarios.php">Top Usuários</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contatos.php">Contatos</a>
        </li>
      </ul>

      <!-- Adicionando o botão "Sair" -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <!--<a class="btn btn-outline-light" href="login.html">Sair</a>-->
          <a class="btn btn-outline-light" href="logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Formulário de Cadastro -->
  <div class="container" style="height: 100vh;">
    <div class="row h-100 justify-content-center align-items-center">
      <main class="col-md-7 col-lg-8">
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
          <h2>Cadastro de Endereços</h2>
          <p class="lead"><strong>Insira os dados corretamente</strong></p>
        </div>
        <form class="needs-validation" novalidate="" name="frmAddAddress" id="frmAddAddress" method="post">
          <div class="row g-3">
            <div class="col-12 d-flex justify-content-start">
              <button name="submit" type="submit" id="btnAddAddress" class="btn btn-outline-dark btn-sm"
                style="width: 150px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                  viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Criar Endereço
              </button>
            </div>

            <div class="row g-3">
              <!-- Código e Data -->
              <div class="col-md-6">
                <label for="codigoEndereco" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigoEndereco" name="codigoEndereco" readonly>
              </div>
              <div class="col-md-6">
                <label for="dataCadastroEndereco" class="form-label">Data Cadastro</label>
                <input type="date" class="form-control" id="dataCadastroEndereco" name="dataCadastroEndereco" required=""
                  readonly>
              </div>
              <script>
                function getDataAtual() {
                  const dataCadastroEndereco = new Date();
                  const ano = dataCadastroEndereco.getFullYear();
                  const mes = String(dataCadastroEndereco.getMonth() + 1).padStart(2, '0');
                  const dia = String(dataCadastroEndereco.getDate()).padStart(2, '0');
                  return `${ano}-${mes}-${dia}`;
                }

                document.addEventListener('DOMContentLoaded', function() {
                  const inputData = document.getElementById('dataCadastroEndereco');
                  inputData.value = getDataAtual();
                });
              </script>

              <div class="col-8">
                <label for="ruaEndereco" class="form-label">Rua</label>
                <input type="text" class="form-control" id="ruaEndereco" name="ruaEndereco" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <div class="col-md-4">
                <label for="numeroEndereco" class="form-label">Número</label>
                <input type="text" class="form-control" id="numeroEndereco" name="numeroEndereco" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <div class="col-md-6">
                <label for="cidadeEndereco" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidadeEndereco" name="cidadeEndereco" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <div class="col-md-3">
                <label for="estadoEndereco" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estadoEndereco" name="estadoEndereco" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <div class="col-md-3">
                <label for="cepEndereco" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cepEndereco" name="cepEndereco" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
            </div>
          </div>
        </form>

        <!-- PESQUISAR -->
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">
              <div class="search-bar d-flex align-items-center">
                <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
                <input id="searchEndereco" class="form-control w-100" type="search"
                  placeholder="Pesquisar Endereço" aria-label="Pesquisar">
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela -->
        <div class="table-container mt-4">
          <table class="table table-hover table-bordered">
            <thead class="table table-sm">
              <tr>
                <!--<th>ID</th>-->
                <th>Rua</th>
                <th>Número</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody id="dadosTabela">
              <!-- Dados carregados dinamicamente -->
            </tbody>
          </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Modal para Visualizar Endereco -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVisualizarLabel">Detalhes do Endereço</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modal-body-content">
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditarEndereco" tabindex="-1" aria-labelledby="modalEditarEnderecoLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarEnderecoLabel">Editar Endereço</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formEditarEndereco">
              <input type="hidden" id="edit_id" name="id"> <div class="mb-3">
                <label for="edit_rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="edit_rua" name="rua" required>
              </div>

              <div class="mb-3">
                <label for="edit_numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="edit_numero" name="numero" required>
              </div>

              <div class="mb-3">
                <label for="edit_cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="edit_cidade" name="cidade" required>
              </div>

              <div class="mb-3">
                <label for="edit_estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="edit_estado" name="estado" required>
              </div>

              <div class="mb-3">
                <label for="edit_cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="edit_cep" name="cep" required>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      // ---------------------------------- MÁSCARA DE CEP -----------------------------------------------------------
      document.addEventListener("DOMContentLoaded", function() {
        const camposCep = ["cepEndereco", "edit_cep"];

        camposCep.forEach(id => {
          const input = document.getElementById(id);
          if (!input) return;

          input.addEventListener("input", function() {
            let cep = input.value.replace(/\D/g, "");

            cep = cep.substring(0, 8);
            let formatado = "";

            if (cep.length > 5) {
               formatado = cep.substring(0, 5) + "-" + cep.substring(5, 8);
            } else {
               formatado = cep;
            }

            input.value = formatado;
          });
        });
      });

      document.addEventListener("keydown", function(event) {
        const element = document.activeElement;
        if (event.key === "Enter" && element.tagName === "INPUT" && !element.form) {
          event.preventDefault();
        }
      });

      $("#frmAddAddress input").on("input", function() {
        if (this.checkValidity()) {
          $(this).removeClass("is-invalid");
        } else {
          $(this).addClass("is-invalid");
        }
      });

      // ---------------------------------- CADASTRAR ENDEREÇO -----------------------------------------------------------

      $('#frmAddAddress').submit(function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
          this.classList.add('was-validated');
          return;
        }

        $.ajax({
          type: "POST",
          url: "conexao/enderecos/cadastrarEndereco.php",
          data: $(this).serialize(),
          success: function(response) {
            const parts = response.split('|');
            const status = parts[0] ? parts[0].trim() : '';
            const message = parts[1] ? parts[1].trim() : response;

            if (status === "1") {
              Swal.fire({
                title: 'Sucesso!',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload(); 
                }
              });

              $('#frmAddAddress').find('input').not('#dataCadastroEndereco').val(''); 
              $('#frmAddAddress').removeClass('was-validated');
            } else {
              Swal.fire('Erro!', message, 'error');
            }
          },
          error: function() {
            Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar o endereço.', 'error');
          }
        });
      });

      // ---------------------------------- PESQUISAR ENDEREÇO -----------------------------------------------------------

      document.addEventListener("DOMContentLoaded", function() {
        carregarEnderecos();

        document.getElementById("searchEndereco").addEventListener("input", function() {
          const termo = this.value.trim();

          if (termo === "") {
            carregarEnderecos();
            return;
          }

          $.ajax({
            url: "conexao/enderecos/pesquisarEndereco.php",
            method: "POST",
            data: { termo: termo },
            success: function(response) {
              document.getElementById("dadosTabela").innerHTML = response;
            },
            error: function() {
              Swal.fire('Erro!', 'Não foi possível buscar os dados.', 'error');
            }
          });
        });
      });

      // ---------------------------------- LISTAR (Carregar Todos) -----------------------------------------------------------
      function carregarEnderecos() {
        $.ajax({
          url: "conexao/enderecos/listarEnderecos.php",
          method: "GET",
          success: function(response) {
            const tabela = $("#dadosTabela");

            if (!response || response.trim().replace(/\s/g, '') === '') {
              tabela.html(`
                <tr>
                  <td colspan="8" class="text-center align-middle text-black py-4">
                    Nenhum endereço encontrado.
                  </td>
                </tr>
              `);
            } else {
              tabela.html(response);
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados.", "error");
          }
        });
      }

      // --------------------------------- VISUALIZAR ------------------------------------------------------------      

      $(document).on("click", ".btn-visualizar", function() {
        const id = $(this).data("id");

        $.ajax({
          url: "conexao/enderecos/visualizarEndereco.php",
          method: "POST",
          data: { id: id },
          success: function(response) {
            $("#modal-body-content").html(response);
            $("#modalVisualizar").modal("show");
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível visualizar os dados.", "error");
          }
        });
      });

      // --------------------------------- EDITAR (Carregar Dados no Modal) ------------------------------------------------------------
      
      $(document).on("click", ".btn-editar", function() {
        const id = $(this).data("id");

        $.ajax({
          url: "conexao/enderecos/editarEndereco.php",
          method: "POST",
          data: { id: id },
          dataType: "json",
          success: function(response) {
            if (response.error) {
              Swal.fire("Erro!", response.error, "error");
            } else {
              $("#edit_id").val(response.id);
              $("#edit_rua").val(response.rua).data("original", response.rua);
              $("#edit_numero").val(response.numero).data("original", response.numero);
              $("#edit_cidade").val(response.cidade).data("original", response.cidade);
              $("#edit_estado").val(response.estado).data("original", response.estado);
              $("#edit_cep").val(response.cep).data("original", response.cep);

              $("#modalEditarEndereco").modal("show");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados do endereço.", "error");
          }
        });
      });

      // --------------------------------- SALVAR EDIÇÃO ------------------------------------------------------------

      $("#formEditarEndereco").submit(function(e) {
        e.preventDefault();

        const id = $("#edit_id").val();
        const rua = $("#edit_rua").val();
        const numero = $("#edit_numero").val();
        const cidade = $("#edit_cidade").val();
        const estado = $("#edit_estado").val();
        const cep = $("#edit_cep").val();

        const houveAlteracao =
          rua !== $("#edit_rua").data("original") ||
          numero !== $("#edit_numero").data("original") ||
          cidade !== $("#edit_cidade").data("original") ||
          estado !== $("#edit_estado").data("original") ||
          cep !== $("#edit_cep").data("original");

        if (!houveAlteracao) {
          Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
          return;
        }

        $.ajax({
          url: "conexao/enderecos/salvarEdicaoEndereco.php",
          method: "POST",
          data: { id, rua, numero, cidade, estado, cep },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              Swal.fire({
                title: "Sucesso!",
                text: response.success,
                icon: "success",
                confirmButtonText: "OK"
              }).then((result) => {
                if (result.isConfirmed) {
                  $("#modalEditarEndereco").modal("hide");
                  location.reload();
                }
              });
            } else {
              Swal.fire("Erro!", response.error, "error");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível salvar as alterações.", "error");
          }
        });
      });

      // --------------------------------- EXCLUIR ------------------------------------------------------------

      $(document).on("click", ".btn-excluir", function() {
        const id = $(this).data("id");

        if (!id) {
          Swal.fire("Erro!", "Nenhum ID foi capturado para exclusão.", "error");
          return;
        }

        Swal.fire({
          title: "Tem certeza?",
          text: "Essa ação não poderá ser desfeita!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Sim, excluir!",
          cancelButtonText: "Cancelar",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "conexao/enderecos/excluirEndereco.php",
              method: "POST",
              data: { id: id },
              dataType: "json",
              success: function(response) {
                if (response.status === "success") {
                  Swal.fire("Excluído!", response.message, "success");
                  carregarEnderecos();
                } else {
                  Swal.fire("Erro!", response.message, "error");
                }
              },
              error: function() {
                Swal.fire("Erro!", "Não foi possível excluir o registro.", "error");
              }
            });
          }
        });
      });

      $('#modalEditarEndereco').on('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          $('#formEditarEndereco').submit();
        }
      });

      document.querySelector("#frmAddAddress").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
          event.preventDefault();
          if (this.checkValidity()) {
            $('#frmAddAddress').submit();
          } else {
            this.classList.add("was-validated");
          }
        }
      });

      document.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
          const confirmBtn = document.querySelector(".swal2-confirm");
          if (confirmBtn && confirmBtn.offsetParent !== null) {
            confirmBtn.click();
          }
        }
      });
    </script>
</body>
</html>