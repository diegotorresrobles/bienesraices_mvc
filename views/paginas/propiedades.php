<main class="contenedor seccion">
    <?php if($_GET['error'] === '1'): ?>
        <div class="alerta error">Propiedad no encontrado</div>
    <?php endif; ?>
    <h1>Propiedades</h1>
    <?php include __DIR__ . '/listado.php'; ?>
</main>