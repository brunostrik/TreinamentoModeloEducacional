public class Reserva {
    private Unidad unidad;
    private Huesped huesped;
    /* Data Class - Encapsulate Data
    private String fechaInicio;
    private String fechaFin;

    public Reserva(Unidad unidad, Huesped huesped, String fechaInicio, String fechaFin) {
        this.unidad = unidad;
        this.huesped = huesped;
        this.fechaInicio = fechaInicio;
        this.fechaFin = fechaFin;
        unidad.setEstado("Reservada");
    }

    public void confirmarReserva(ContextoNotificacion contexto, MetodoPago metodoPago, double monto) {
        metodoPago.realizarPago(monto);
        contexto.enviar("Reserva confirmada para " + huesped.getNombre() + " en unidad: " + unidad.getTipo(), huesped);
    }
    */
    /* Data Clumps - Introduce Parameter Object
    private LocalDate fechaInicio;
    private LocalDate fechaFin;
     */
    private PeriodoReserva periodo;
    private boolean confirmada;

    public Reserva(Unidad unidad, Huesped huesped, PeriodoReserva periodo) {
        this.unidad = unidad;
        this.huesped = huesped;
        this.periodo = periodo;
        this.confirmada = false;
    }

    public void confirmarReserva(ContextoNotificacion contexto, MetodoPago metodoPago, double monto) {
        metodoPago.realizarPago(monto);
        this.confirmada = true;
        contexto.enviar("Reserva confirmada para " + huesped.getNombre() + " en unidad: " + unidad.getTipo(), huesped);
    }

    public boolean isConfirmada() {
        return confirmada;
    }
}