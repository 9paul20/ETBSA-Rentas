import { defineStore } from "pinia";
import axios from 'axios';
import { ref, computed } from "vue";

export const useRentsIndex = defineStore('rents-index', () => {
    let columnNames = ref([]);
    let rowDatas = ref({});
    let filteredRowDatas = ref({});
    let tableRentsTransition = ref(false);
    let categoriesList = ref([]);
    let statusRentsList = ref([]);

    //Metodos
    const index = async () => {
        try {
            const { data } = await axios.get('http://etbsa-rentas.test/api/RentsListAPI');
            columnNames.value = [...data.columnNames];
            rowDatas.value = { ...data.rowDatas };
            filteredRowDatas.value = rowDatas.value.data;
            categoriesList.value = [...data.categories];
            statusRentsList.value = [...data.statusRents];
            tableRentsTransition.value = !tableRentsTransition.value;
        } catch (error) {
            console.error(error);
        }
    };
    const filterRentsByEquipmentNoSerie = (rowData, queryEquipmentNoSerie) => {
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
    const filterRentsByEquipmentCategory = (rowData, queryEquipmentCategory) => {
        return (
            queryEquipmentCategory == '' ||
            queryEquipmentCategory == null ||
            rowData.equipment.categoria.categoria.toLowerCase().includes(queryEquipmentCategory.toLowerCase())
        );
    };
    const filterRentsByRentSatus = (rowData, queryStatusRent) => {
        return (
            queryStatusRent == '' ||
            queryStatusRent == null ||
            rowData.status_rent.estadoRenta.toLowerCase().includes(queryStatusRent.toLowerCase())
        );
    };
    //Filtro
    const filterRents = (queryEquipmentNoSerie, queryClientName, queryEquipmentCategory, queryStatusRent) => {
        filteredRowDatas.value = rowDatas.value.data.filter(rowData => {
            return (
                filterRentsByEquipmentNoSerie(rowData, queryEquipmentNoSerie) &&
                filterRentsByClient(rowData, queryClientName) &&
                filterRentsByEquipmentCategory(rowData, queryEquipmentCategory) &&
                filterRentsByRentSatus(rowData, queryStatusRent)
            );
        });
    };

    return {
        columnNames,
        rowDatas,
        filteredRowDatas,
        categoriesList,
        statusRentsList,
        tableRentsTransition,
        index,
        filterRentsByEquipmentNoSerie,
        filterRentsByClient,
        filterRentsByEquipmentCategory,
        filterRentsByRentSatus,
        filterRents
    };
});