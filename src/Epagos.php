<?php

namespace Epagos;

use Epagos\Exceptions\EpagosException;
use SoapClient;
use SoapFault;

class Epagos
{
    public SoapClient $client;
    public string $version;
    public array $credenciales = [];

    public function __construct(string $wsdl)
    {
        $soap_version = SOAP_1_1;
        $cache_wsdl = WSDL_CACHE_NONE;
        $trace = true;

        try {
            $this->client = new SoapClient($wsdl, array_slice(get_defined_vars(), -3));
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
        $this->version = number_format(2, 1);
    }

    public function obtenerToken(array $credenciales): array
    {
        try {
            $respuesta = $this->client->obtener_token($this->version, $credenciales);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
        $respuesta = array_merge($credenciales, $respuesta);
        list($id_organismo, $token) = array(null, null);

        $this->credenciales = array_intersect_key($respuesta, array_slice(get_defined_vars(), -2));
        return $respuesta;
    }

    public function obtenerEntidadesPago(array $fp = []): array
    {
        try {
            return $this->client->obtener_entidades_pago($this->version, $this->credenciales, $fp);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerPagos(array $pago): array
    {
        try {
            return $this->client->obtener_pagos($this->version, $this->credenciales, $pago);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerContracargos(array $contracargos): array
    {
        try {
            return $this->client->obtener_contracargos($this->version, $this->credenciales, $contracargos);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerRendiciones(array $rendicion): array
    {
        try {
            return $this->client->obtener_rendiciones($this->version, $this->credenciales, $rendicion);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerPagosAdicionales(array $pagos): array
    {
        try {
            return $this->client->obtener_pagos_adicionales($this->version, $this->credenciales, $pagos);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function solicitudPago(array $operacion, array $fp, $convenio): array
    {
        try {
            return $this->client->solicitud_pago($this->version, 'op_pago', $this->credenciales, $operacion, $fp, $convenio);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function solicitudPagoLote(array $lote): array
    {
        try {
            return $this->client->solicitud_pago_lote($this->version, 'op_pago', $this->credenciales, $lote);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function pagoLote(array $pagoLote): array
    {
        try {
            return $this->client->pago_lote($this->version, $this->credenciales, $pagoLote);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function solicitudPagoRecurrente(array $operacion, $convenio, string $medio, array $cliente, string $fechaDebito = null): array
    {
        try {
            return $this->client->solicitud_pago_recurrente($this->version, 'op_pago_recurrente', $this->credenciales, $operacion, $convenio, $medio, $cliente, $fechaDebito);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function registrarCuentasCliente(array $cuentas): array
    {
        try {
            return $this->client->registrar_cuentas_cliente($this->version, $this->credenciales, $cuentas);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerCuentasCliente(array $datosCliente): array
    {
        try {
            return $this->client->obtener_cuentas_cliente($this->version, $this->credenciales, $datosCliente);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerTarjetasCliente(array $datosCliente): array
    {
        try {
            return $this->client->obtener_tarjetas_cliente($this->version, $this->credenciales, $datosCliente);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }

    public function obtenerResultadosDebito(array $datosDebito): array
    {
        try {
            return $this->client->obtener_resultados_debito($this->version, $this->credenciales, $datosDebito);
        } catch (SoapFault $fault) {
            throw new EpagosException($fault->getMessage());
        }
    }
}
