import { defineStore } from "pinia";
import axios from 'axios';
import { ref, computed } from "vue";

export const useRentsIndex = defineStore('rents-index', () => {
    let columnNames = ref([]);
    let rowDatas = ref({});
    let filteredRowDatas = ref({});
    let tableRentsTransition = ref(false);

    //Metodos
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
    };
    const filterRentsByNoSerieEquipo = (rowData, queryEquipmentNoSerie) => {
        return (
            queryEquipmentNoSerie == '' ||
            queryEquipmentNoSerie == null ||
            rowData.equipment.noSerieEquipo.toLowerCase().includes(queryEquipmentNoSerie.toLowerCase())
        );
    };

    const filterRentsByClient = (rowData, queryClientName) => {
        return (
            queryClientName == '' ||
            queryClientName == null ||
            rowData.person.nombrePersona.toLowerCase().includes(queryClientName.toLowerCase()) ||
            rowData.person.apePaternoPersona.toLowerCase().includes(queryClientName.toLowerCase()) ||
            rowData.person.apeMaternoPersona.toLowerCase().includes(queryClientName.toLowerCase())
        );
    };
    const filterRents = (queryEquipmentNoSerie, queryClientName) => {
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                filterRentsByNoSerieEquipo(rowData, queryEquipmentNoSerie) &&
                filterRentsByClient(rowData, queryClientName)
            );
        });
    };

    return {
        columnNames,
        rowDatas,
        filteredRowDatas,
        tableRentsTransition,
        index,
        filterRentsByNoSerieEquipo,
        filterRentsByClient,
        filterRents
    };
});