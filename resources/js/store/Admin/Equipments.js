import axios from 'axios';
import { ref } from "vue";

export const equipments = ('equipments-create', () => {
    const listCategories = ref();
    const listStatus = ref();
    // gets date formatted as yyyy-MM-dd
    const datePickerFormat = 'yyyy-MM-dd';
    const formatDate = (date) => {
        if (date) {
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            return formattedDate;
        }
        else {
            return '';
        }
    }
    //modelo
    const equipment = ref({
        noSerieEquipo: '',
        noSerieMotor: '',
        noEconomico: '',
        modelo: '',
        clvDisponibilidad: '',
        clvCategoria: '',
        descripcion: '',
        precioEquipo: '',
        folioEquipo: '',
        fechaAdquisicion: '',
        fechaGarantiaExtendida: '',
        porDeprAnual: '',
    });
    const errors = ref({
        noSerieEquipo: '',
        noSerieMotor: '',
        noEconomico: '',
        modelo: '',
        clvDisponibilidad: '',
        clvCategoria: '',
        descripcion: '',
        precioEquipo: '',
        folioEquipo: '',
        fechaAdquisicion: '',
        fechaGarantiaExtendida: '',
        porDeprAnual: '',
    });
    let clvDisponibilidadValue = '';
    let clvCategoriaValue = '';
    //Metodos
    const getStatus = async () => {
        try {
            const dataStatus = await axios.get('http://etbsa-rentas.test/api/StatusListAPI');
            listStatus.value = dataStatus;
            return listStatus.value.data;
        } catch (error) {
            console.error(error);
        }
    };
    const getCategories = async () => {
        try {
            const dataCategories = await axios.get('http://etbsa-rentas.test/api/CategoriesListAPI');
            listCategories.value = dataCategories;
            return listCategories.value.data;
        } catch (error) {
            console.error(error);
        }
    };
    const clvs = (clvDisponibilidad, clvCategoria) => {
        clvDisponibilidadValue = clvDisponibilidad;
        clvCategoriaValue = clvCategoria;
        // console.log("Console desde Equipments.js: ", clvDisponibilidadValue, clvCategoriaValue);
    };
    const post = async () => {
        //Constantes para almacenar valores
        const fechaAdquisicion = equipment.value.fechaAdquisicion;
        const fechaGarantiaExtendida = equipment.value.fechaGarantiaExtendida;
        const formattedFechaAdquisicion = formatDate(fechaAdquisicion);
        const formattedFechaGarantiaExtendida = formatDate(fechaGarantiaExtendida);
        //Asignación de los valores formateados
        equipment.value.fechaAdquisicion = formattedFechaAdquisicion;
        equipment.value.fechaGarantiaExtendida = formattedFechaGarantiaExtendida;
        //Asignación de los listBox correspondientes
        equipment.value.clvDisponibilidad = clvDisponibilidadValue;
        equipment.value.clvCategoria = clvCategoriaValue;

        // console.log(equipment.value);

        try {
            const response = await axios.post('http://etbsa-rentas.test/api/EquipmentsListAPI', equipment.value)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            // console.error(error.response.data.errors);
            // console.error(error.response.data.message);
            console.error(error.response.data);
            if (error.response.data.errors.noSerieEquipo)
                errors.value.noSerieEquipo = error.response.data.errors.noSerieEquipo;
            if (error.response.data.errors.noSerieMotor)
                errors.value.noSerieMotor = error.response.data.errors.noSerieMotor;
            if (error.response.data.errors.noEconomico)
                errors.value.noEconomico = error.response.data.errors.noEconomico;
            if (error.response.data.errors.modelo)
                errors.value.modelo = error.response.data.errors.modelo;
            if (error.response.data.errors.clvDisponibilidad)
                errors.value.clvDisponibilidad = error.response.data.errors.clvDisponibilidad;
            if (error.response.data.errors.clvCategoria)
                errors.value.clvCategoria = error.response.data.errors.clvCategoria;
            if (error.response.data.errors.descripcion)
                errors.value.descripcion = error.response.data.errors.descripcion;
            if (error.response.data.errors.precioEquipo)
                errors.value.precioEquipo = error.response.data.errors.precioEquipo;
            if (error.response.data.errors.folioEquipo)
                errors.value.folioEquipo = error.response.data.errors.folioEquipo;
            if (error.response.data.errors.fechaAdquisicion)
                errors.value.fechaAdquisicion = error.response.data.errors.fechaAdquisicion;
            if (error.response.data.errors.fechaGarantiaExtendida)
                errors.value.fechaGarantiaExtendida = error.response.data.errors.fechaGarantiaExtendida;
            if (error.response.data.errors.porDeprAnual)
                errors.value.porDeprAnual = error.response.data.errors.porDeprAnual;
        }

        //Asignación de valores originales(Necesario para volver a enviar el formulario en Date(), en caso de formular mal los datos)
        equipment.value.fechaAdquisicion = fechaAdquisicion;
        equipment.value.fechaGarantiaExtendida = fechaGarantiaExtendida;
    };

    const get = async (id) => {
        //
        try {
            //
            const response = await axios.get(`http://etbsa-rentas.test/api/EquipmentsListAPI/${id}`)
                .then(res => {
                    console.log(res);
                });
        } catch (error) {
            console.error(error);
        }
    }

    return { datePickerFormat, formatDate, equipment, errors, getStatus, getCategories, clvs, post, get };
});