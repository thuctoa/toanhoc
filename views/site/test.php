<input type="text" id="search" name="search" onchange="hideIcon(this);" value="search" />
<style>
    input#search {
        background-image: url(/img/anh10.jpg);
        background-repeat: no-repeat;
        text-indent: 20px;
    }
</style>
<script>
    function hideIcon(self) {
        self.style.backgroundImage = 'none';
    }
</script>