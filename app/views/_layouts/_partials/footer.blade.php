<footer>
<script>
var activePage = "{{ $activePage or null }}";
$('#navtab-' + activePage).addClass('active');
</script>
</footer>