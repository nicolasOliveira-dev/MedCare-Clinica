<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: autenticacao.php');
    exit();
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? 'Usuário';
$primeiraLetra = strtoupper(substr($nomeUsuario, 0, 1));

require_once '../app/Core/Conexao.php';
$pdo = Conexao::getConexao();

$pageTitle = 'Relatórios';
$currentPage = 'relatorios';
$headerTitle = 'Painel Administrativo';
$headerSubtitle = 'Visualização de Views SQL';
$pageStyles = ['relatorios.css'];

/* -------- CONSULTAR AS VIEWS -------- */

$vwConsultasFuturas = $pdo->query("SELECT * FROM vw_consultas_futuras")->fetchAll(PDO::FETCH_ASSOC);
$vwTotalConsultasPorMedico = $pdo->query("SELECT * FROM vw_total_consultas_por_medico")->fetchAll(PDO::FETCH_ASSOC);
$vwMetricasDuracao = $pdo->query("SELECT * FROM vw_metricas_duracao_por_medico")->fetchAll(PDO::FETCH_ASSOC);
$vwMedicosAtivos30d = $pdo->query("SELECT * FROM vw_medicos_ativos_30d")->fetchAll(PDO::FETCH_ASSOC);

include 'partials/_head.php';
include 'partials/_sidebar.php';
?>
<main class="main-content">
<?php include 'partials/_header.php'; ?>

<section class="management-card reports-card">
    <div class="management-header">
        <div class="title-section">
            <h2>Views do Banco de Dados</h2>
            <p>Listagem direta das views criadas no MySQL</p>
        </div>
    </div>

    <!-- VIEW 1 -->
    <div class="report-block">
        <h4><i class="fas fa-calendar"></i> Consultas Futuras</h4>
        <?php if ($vwConsultasFuturas): ?>
            <table class="table-data">
                <thead><tr>
                    <?php foreach (array_keys($vwConsultasFuturas[0]) as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr></thead>
                <tbody>
                    <?php foreach ($vwConsultasFuturas as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?><p>Nenhum registro encontrado.</p><?php endif; ?>
    </div>

    <!-- VIEW 2 -->
    <div class="report-block">
        <h4><i class="fas fa-user-md"></i> Total de Consultas por Médico</h4>
        <?php if ($vwTotalConsultasPorMedico): ?>
            <table class="table-data">
                <thead><tr>
                    <?php foreach (array_keys($vwTotalConsultasPorMedico[0]) as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr></thead>
                <tbody>
                    <?php foreach ($vwTotalConsultasPorMedico as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?><p>Nenhum registro encontrado.</p><?php endif; ?>
    </div>

    <!-- VIEW 3 -->
    <div class="report-block">
        <h4><i class="fas fa-clock"></i> Métricas de Duração por Médico</h4>
        <?php if ($vwMetricasDuracao): ?>
            <table class="table-data">
                <thead><tr>
                    <?php foreach (array_keys($vwMetricasDuracao[0]) as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr></thead>
                <tbody>
                    <?php foreach ($vwMetricasDuracao as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?><p>Nenhum registro encontrado.</p><?php endif; ?>
    </div>

    <!-- VIEW 4 -->
    <div class="report-block">
        <h4><i class="fas fa-chart-line"></i> Médicos ativos nos últimos 30 dias</h4>
        <?php if ($vwMedicosAtivos30d): ?>
            <table class="table-data">
                <thead><tr>
                    <?php foreach (array_keys($vwMedicosAtivos30d[0]) as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr></thead>
                <tbody>
                    <?php foreach ($vwMedicosAtivos30d as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?><p>Nenhum registro encontrado.</p><?php endif; ?>
    </div>

</section>

<?php include 'partials/_footer.php'; ?>
