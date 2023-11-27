            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022-<?= date("Y"); ?> <a href="https://josephmn.github.io/web/"><?= $_SERVER['COMPANY']?></a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- JavaScript  -->
    <script>
        const baseurl = '<?php echo base_url() ?>';
    </script>
    <!-- Aquí cargas tus archivos JS comunes -->
    <?php foreach ($js as $jsFile): ?>
        <script src="<?= $jsFile; ?>"></script>
    <?php endforeach; ?>
</body>

</html>