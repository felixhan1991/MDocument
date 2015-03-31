<script type="text/javascript">
function changeInterval(id_selected)
{
    var elem=document.getElementById("start");
    var elem2=document.getElementById("end");
    
    if(id_selected!==2){
        while (elem.firstChild) {
            elem.removeChild(elem.firstChild);}
        while (elem2.firstChild) {
            elem2.removeChild(elem2.firstChild);}
    
    var elem3=document.getElementById("start1");
    var elem4=document.getElementById("end1");
    elem3.style.display = 'none';
    elem4.style.display = 'none';
    elem.style.display = 'block';
    elem2.style.display = 'block';
    elem3.name='start1';
    elem4.name='end1'
    elem.name='start';
    elem2.name='end';
    var option;
    if(id_selected===0){
    <?php  foreach($years as $year){ ?>
    option=document.createElement("option");
    option.value="<?= $year->parameter_dokumen; ?>";
    option.text="<?= $year->parameter_dokumen; ?>";
    elem.add(option);
    <?php } ?>
    
    <?php foreach($years as $year){ ?>
        option=document.createElement("option");
        option.value="<?= $year->parameter_dokumen; ?>";
    option.text="<?= $year->parameter_dokumen; ?>";
    elem2.add(option);
    <?php } ?>
    }
    else if(id_selected===1){
    <?php foreach($months as $month){ ?>
    option=document.createElement("option");
    option.value="<?= $month->parameter_dokumen; ?>";
    option.text="<?= $month->parameter_dokumen; ?>";
    elem.add(option);
    <?php } ?>
    
    <?php foreach($months as $month){ ?>
    option=document.createElement("option");
    option.value="<?= $month->parameter_dokumen; ?>";
    option.text="<?= $month->parameter_dokumen; ?>";
    elem2.add(option);
    <?php } ?>
    }
    }
    else
    {
        while (elem.firstChild) {
            elem.removeChild(elem.firstChild);}
        while (elem2.firstChild) {
            elem2.removeChild(elem2.firstChild);}
        var elem3=document.getElementById("start1");
        var elem4=document.getElementById("end1");
        elem.style.display = 'none';
        elem2.style.display = 'none';
        elem3.style.display = 'block';
        elem4.style.display = 'block';
        elem.name='start1';
        elem2.name='end1'
        elem3.name='start';
        elem4.name='end';
        elem3.value='';
        elem4.value='';
        
    }
}
</script>