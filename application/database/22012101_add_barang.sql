CREATE TABLE barang ( 
    `id` SERIAL NOT NULL , 
    `kd_barang` VARCHAR(32) NOT NULL ,
    `nama` VARCHAR(32) NOT NULL , 
    `harga` numeric(10, 0) NOT NULL ,
    `stok` int(11) NOT NULL ,
    `satuan` VARCHAR(32) NOT NULL ,
    `keterangan` TEXT NULL,
    PRIMARY KEY (`id`));
