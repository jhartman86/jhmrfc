<?php namespace Concrete\Package\Jhmr\Block\PhotoWall;

    use Loader;
    use FileList;
    use FileSet;

    class Controller extends \Concrete\Core\Block\BlockController {

        const FILE_SOURCE_CUSTOM    = 0,
              FILE_SOURCE_SET       = 1;

        public static $fileSourceOptions = array(
            self::FILE_SOURCE_CUSTOM => 'Custom',
            self::FILE_SOURCE_SET    => 'Use File Set'
        );

        protected $btTable 									= 'btPhotoWall';
        protected $btTableSecondary                         = 'btPhotoWallFiles';
        protected $btInterfaceWidth 						= '650';
        protected $btInterfaceHeight						= '480';
        protected $btDefaultSet                             = 'artsy';
        protected $btCacheBlockRecord 						= true;
        protected $btCacheBlockOutput 						= true;
        protected $btCacheBlockOutputOnPost 				= true;
        protected $btCacheBlockOutputForRegisteredUsers 	= false;
        protected $btCacheBlockOutputLifetime 				= 0;

        public $fileSource;
        public $fileSetID;

        public function getBlockTypeDescription(){
            return t("Add a photo wall");
        }


        public function getBlockTypeName(){
            return t("Photo Wall");
        }


        public function view(){
            $this->set('fileListResults', $this->fileListObj()->getResults());
        }


        public function add(){
            $this->edit();
        }


        public function composer(){
            $this->edit();
        }


        public function edit(){
            $this->requireAsset('core/file-manager');
            $this->set('fileListResults', $this->fileListObj()->getResults());
            $this->set('availableFileSets', array('' => 'Choose A File Set') + $this->availableFileSets());
        }


        /**
         * @return \Concrete\Core\File\FileList
         */
        protected function fileListObj(){
            if( $this->_fileListObj === null ){
                $this->_fileListObj = new FileList();
                $this->applyFileListFilters($this->_fileListObj);
            }
            return $this->_fileListObj;
        }


        /**
         * Apply any customizations to the FileList query
         * @param \Concrete\Core\File\FileList $fileListObj
         */
        protected function applyFileListFilters( \Concrete\Core\File\FileList $fileListObj ){
            if( (int)$this->fileSource === self::FILE_SOURCE_CUSTOM ){
                $fileListObj->getQueryObject()->join('f', $this->btTableSecondary, 'btsecondary', 'f.fID = btsecondary.fileID');
                $fileListObj->getQueryObject()->andWhere('btsecondary.bID = :bRecordID');
                $fileListObj->getQueryObject()->setParameter(':bRecordID', $this->bID);
                $fileListObj->getQueryObject()->orderBy('btsecondary.displayOrder', 'asc');
            }

            if( (int)$this->fileSource === self::FILE_SOURCE_SET ){
                $fileSetObj = FileSet::getByID((int)$this->fileSetID);
                if( is_object($fileSetObj) ){
                    $fileListObj->filterBySet($fileSetObj);
                    $fileListObj->sortByFileSetDisplayOrder();
                }
            }
        }


        /**
         * Get a list of available file sets.
         * @return Array
         */
        protected function availableFileSets(){
            if( $this->_availableFileSets === null ){
                $fileSetListObj = new \Concrete\Core\File\Set\SetList;
                $fileSetListObj->filterByType(\Concrete\Core\File\Set\Set::TYPE_PUBLIC);
                $fileSets = $fileSetListObj->get();

                $this->_availableFileSets = array();
                foreach($fileSets AS $fileSetObj){ /** @var $fileSetObj \Concrete\Core\File\Set\Set */
                    $this->_availableFileSets[$fileSetObj->getFileSetID()] = $fileSetObj->getFileSetName();
                }
            }
            return $this->_availableFileSets;
        }


        /**
         * Called automatically by framework
         * @param array $args
         */
        public function save( $args ){
            parent::save(array(
                'fileSource' => (int) $args['fileSource'],
                'fileSetID'  => (int) $args['fileSetID']
            ));

            $this->persistFiles( (array) $args['fileID'] );
        }


        /**
         * Purge any previously stored records first and rewrite everything.
         * @param array $fileIDs
         * @return void
         */
        protected function persistFiles( array $fileIDs = array() ){
            $db = Loader::db();
            $fileIDs = array_unique($fileIDs);
            $db->Execute("DELETE FROM {$this->btTableSecondary} WHERE bID = ?", array($this->bID));
            foreach( $fileIDs AS $orderIndex => $fileID ){
                $db->Execute("INSERT INTO {$this->btTableSecondary} (bID, fileID, displayOrder) VALUES(?,?,?)", array(
                    $this->bID, $fileID, ($orderIndex + 1)
                ));
            }
        }


        /**
         * Ensure when block version gets copied we dont lose data!
         * @param $newBID
         * @return void
         */
        public function duplicate( $newBID ){
            $db = Loader::db();

            // Copy the current block record
            $db->Execute("INSERT INTO btPhotoWall (bID, fileSource, fileSetID) VALUES(?,?,?)", array(
                $newBID, $this->fileSource, $this->fileSetID
            ));

            // Copy records from files table
            $r  = $db->query("SELECT * FROM btPhotoWallFiles WHERE bID = ?", array($this->bID));
            foreach($r AS $row){
                $db->Execute("INSERT INTO btPhotoWallFiles (bID, fileID, displayOrder) VALUES (?,?,?)", array(
                    $newBID, $row['fileID'], $row['displayOrder']
                ));
            }
        }


        /**
         * Make sure to delete all files associated w/ the block record in secondary table.
         * @return void
         */
        public function delete(){
            Loader::db()->Execute("DELETE FROM {$this->btTableSecondary} WHERE bID = ?", array(
                $this->bID
            ));
            return parent::delete();
        }

    }