<div id="image-select-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="image-select-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" bt_controller="MediaLibraryController" bt_ready="initialize">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Media library</h4>
                
                <ul class="nav nav-tabs">
                    <li><a href="#upload" data-toggle="tab">Upload from computer</a></li>
                    <li class="active"><a href="#library" data-toggle="tab">Library</a></li>
                </ul>
                <div class="modal-overflow">
                    <div class="tab-content">
                        <div class="tab-pane" id="upload" bt_controller="UploadController" bt_ready="initialize">

                            <div class="upload">
                                <!-- Drop Zone -->
                                <div class="upload-drop-zone" id="drop-zone">
                                    <p>Just drag and drop files here</p>
                                    <p>or</p>
                                    <button class="btn btn-default btn-upload">Select file(s) from computer</button>
                                </div>
                            
                                <!-- Upload Finished -->
                                <div class="upload-container hide">
                                    <h4>Process</h4>
                                    
                                    <div class="list-group">
										<!-- Dynamical content -->
                                    </div>
                                </div> 
                            </div>             
                        </div>
                        <div class="tab-pane active in" id="library">
                            <div class="file-info-container pull-right">                                
                                <dl class="file-info hidden">
                                    <dd><img class="file-info-image" src="{{ asset('assets/cms/images/placeholders/image.png') }}" alt="Alt" /></dd>
                                    
                                    <dt>Filename:</dt>
                                    <dd class="file-info-filename">-</dd>
                                    
                                    <dt>Dimensions:</dt>
                                    <dd class="file-info-dimensions">0x0</dd>
                                    
                                    <dd><a href="javascript:void(0);">delete permanently</a></dd>
                                </dl>
                            </div>
                            
                            <div class="file-library-container">
                                <form class="search-media pull-right" role="search">
                                   <div class="input-group">
                                        <div class="inner-addon right-addon">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            <input type="text" class="form-control filter" placeholder="Search for..." bt_filter=".filterable" />
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="container-fluid media-library-container">
                                    <div class="simple-loader">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span class="sr-only">Loading..</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-select-image" disabled="disabled" bt_click="selectImage">Select image</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->