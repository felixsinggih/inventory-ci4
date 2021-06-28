CREATE view vhistory AS
(SELECT barang.id_barang, barang.nm_barang, suplai_detail.jumlah, suplai.id_suplai AS id, barang.satuan, suplai.created_at
FROM suplai, suplai_detail, barang
WHERE suplai.id_suplai = suplai_detail.id_suplai
AND suplai_detail.id_barang = barang.id_barang)
UNION
(SELECT barang.id_barang, barang.nm_barang, keluar_detail.jumlah, keluar.id_keluar AS id, barang.satuan, keluar.created_at
FROM keluar, keluar_detail, barang
WHERE keluar.id_keluar = keluar_detail.id_keluar
AND keluar_detail.id_barang = barang.id_barang)