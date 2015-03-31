<script type="text/javascript">
var TreeView = function () {
var url =window.location.protocol.concat("//");
    url = url.concat(window.location.hostname);
    var url2= window.location.pathname;
    var port= window.location.port;
    url = url.concat(":");
    url = url.concat(port);
    url = url.concat("/");
    var res = url2.split("/");
    url = url.concat(res[1]);
    
    return {
        //main function to initiate the module
        init: function () {

            var DataSourceTree = function (options) {
                this._data  = options.data;
                this._delay = options.delay;
                this._incre=0;
            };

            DataSourceTree.prototype = {

                data: function (options, callback) {
                    var self = this;
                    self._incre++;
                    console.log(self._incre);
                    setTimeout(function () {
                        if (self._incre<2)
                            {
                            var data = $.extend(true, [], self._data);
                            }
                        else 
                            {
                                url_view = url;
                                
                                url_view = url_view.concat("/kategori/getChild");
                                var data1=[];
                                
                                $.ajax({
                                    type: "get",
                                    url: url_view,
                                    cache: false,				
                                    data: {
                                      id:options.params.id
                                    },
                                    success: function(json){						
                                    try{		
                                            var obj = jQuery.parseJSON(json);
                                            console.log(obj);
                                            document.getElementById('result').innerHTML = obj.docs;
                                            var list = obj.list;
                                            list.forEach(function(entry) {
                                                data1.push({ name: entry.nama_kategori+' <div class="tree-actions"></div>', type: 'folder', params: { id: entry.id_kategori } });
                                            });
                                    }catch(e) {		
                                        e.toString();
                                            alert('Exception while request..');
                                    }		
                                    },
                                    async: false,
                                    error: function(){						
                                            alert('Error while request..');
                                    }
                                });
                                
                                var data = $.extend(true, [], data1);
                            }
                        callback({ data: data });

                    }, this._delay)
                }
            };

            // INITIALIZING TREE
            var treeDataSource2 = new DataSourceTree({
               data: [
                    <?php
                    if (isset($kategoris))
                    {
                        foreach ($kategoris as $k)
                        {
                            echo "{ name: '$k->nama_kategori', type: 'folder', params: { id: '$k->id_kategori' } }, ";
                        }
                    }
                    ?>
                ],
                delay: 400
            });
            
            $('#FlatTree2').tree({
                dataSource: treeDataSource2,
                loadingHTML: '<img src="<?php echo base_url().APPPATH.'themes/default/views/'?>images/input-spinner.gif"/>',
            });





        }

    };

}();

</script>