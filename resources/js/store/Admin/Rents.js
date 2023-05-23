import { defineStore } from "pinia";
import axios from 'axios';
import { ref } from "vue";

export const useRentsIndex = defineStore('rents-index', () => {
    let columnNames = ref([]);
    let rowDatas = ref({});
    let tableRentsTransition = ref(false);
    const filteredRowDatas = ref({});
    const index = async () => {
        try {
            const { data } = await axios.get('http://etbsa-rentas.test/api/RentsListAPI');
            columnNames.value = [...data.columnNames];
            rowDatas.value = { ...data.rowDatas };
            filteredRowDatas.value = rowDatas.value.data;
            tableRentsTransition.value = !tableRentsTransition.value;
        } catch (error) {
            console.error(error);
        }
        // nextTick(() => { })
    };
    const filterByEquipmentNoSerie = (queryEquipmentNoSerie) => {
        if (queryEquipmentNoSerie == '') {
            filteredRowDatas.value = rowDatas.value.data;
            return;
        }
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                rowData.equipment.noSerieEquipo.toLowerCase().includes(queryEquipmentNoSerie.toLowerCase())
            );
        });
    };
    const filterByClientName = (queryClientName) => {
        if (queryClientName === '') {
            filteredRowDatas.value = rowDatas.value.data;
            return;
        }
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                rowData.person.nombrePersona.toLowerCase().includes(queryClientName.toLowerCase()) ||
                rowData.person.apePaternoPersona.toLowerCase().includes(queryClientName.toLowerCase()) ||
                rowData.person.apeMaternoPersona.toLowerCase().includes(queryClientName.toLowerCase())
            );
        });
    };

    return { columnNames, rowDatas, tableRentsTransition, index, filteredRowDatas, filterByEquipmentNoSerie, filterByClientName };
});