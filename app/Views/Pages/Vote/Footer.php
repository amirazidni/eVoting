<button class="btn px-4 py-2 btn-primary" style="position: fixed; bottom: 10%; right: 3.5%;" type="button" onclick="callOperator()">Hubungi Operator</button>

<script>
    function callOperator() {
        window.open('<?= base_url('voter/comitteeMessage'); ?>', '_blank')
    }
</script>

</body>

</html>