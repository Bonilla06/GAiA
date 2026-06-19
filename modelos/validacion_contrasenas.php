<?php


class ValidacionContrasenas {

    // Criterios de complejidad
    const LONGITUD_MINIMA = 8;
    const CARACTERES_ESPECIALES = '!@#$%^&*()-_=+[]{}|;:\'",.<>?/`~';

    /**
     * Valida una contraseña contra todos los criterios
     * 
     * @param string $contrasena La contraseña a validar
     * @return array Array con 'valida' (bool) y 'errores' (array de mensajes)
     */
    public static function validarContrasena($contrasena) {
        $errores = array();
        
        // Validar longitud mínima
        if (strlen($contrasena) < self::LONGITUD_MINIMA) {
            $errores[] = "La contraseña debe tener al menos " . self::LONGITUD_MINIMA . " caracteres.";
        }
        
        // Validar que contenga al menos una mayúscula
        if (!preg_match('/[A-Z]/', $contrasena)) {
            $errores[] = "La contraseña debe contener al menos una letra mayúscula.";
        }
        
        // Validar que contenga al menos una minúscula
        if (!preg_match('/[a-z]/', $contrasena)) {
            $errores[] = "La contraseña debe contener al menos una letra minúscula.";
        }
        
        // Validar que contenga al menos un número
        if (!preg_match('/[0-9]/', $contrasena)) {
            $errores[] = "La contraseña debe contener al menos un número.";
        }
        
        // Validar que contenga al menos un carácter especial
        if (!preg_match('/[!@#$%^&*()\-_=+\[\]{}|;:\'",.<>?\/`~]/', $contrasena)) {
            $errores[] = "La contraseña debe contener al menos un carácter especial (!@#$%^&*).";
        }
        
        return array(
            'valida' => empty($errores),
            'errores' => $errores
        );
    }

    /**
     * Verifica si una contraseña cumple los criterios mínimos (solo en cliente)
     * Retorna un objeto JSON con el estado de cada criterio
     * 
     * @param string $contrasena La contraseña a verificar
     * @return array Array con estado de cada criterio
     */
    public static function obtenerEstadoCriterios($contrasena) {
        return array(
            'longitud' => strlen($contrasena) >= self::LONGITUD_MINIMA,
            'mayuscula' => (bool) preg_match('/[A-Z]/', $contrasena),
            'minuscula' => (bool) preg_match('/[a-z]/', $contrasena),
            'numero' => (bool) preg_match('/[0-9]/', $contrasena),
            'especial' => (bool) preg_match('/[!@#$%^&*()\-_=+\[\]{}|;:\'",.<>?\/`~]/', $contrasena),
            'todoCumple' => self::validarContrasena($contrasena)['valida']
        );
    }

    /**
     * Genera el hash seguro de una contraseña usando password_hash (bcrypt)
     * 
     * @param string $contrasena La contraseña en texto plano
     * @return string Hash bcrypt de la contraseña
     */
    public static function hashear($contrasena) {
        return password_hash($contrasena, PASSWORD_BCRYPT, array('cost' => 12));
    }

    /**
     * Verifica una contraseña contra su hash
     * 
     * @param string $contrasena La contraseña en texto plano
     * @param string $hash El hash almacenado
     * @return bool True si la contraseña coincide con el hash
     */
    public static function verificar($contrasena, $hash) {
        // Si el hash es un hash password_hash, usar password_verify
        if (password_needs_rehash($hash, PASSWORD_BCRYPT) !== false || strpos($hash, '$2') === 0) {
            return password_verify($contrasena, $hash);
        }
        
        // Compatibilidad con hashes antiguos de crypt (migración)
        // Usamos crypt con la misma sal para comparar
        $comparacion = crypt($contrasena, '$2a$07$asdfsdvafdsgf04sdfsadfGAiADeveloper$');
        return hash_equals($comparacion, $hash);
    }

    /**
     * Verifica si un hash necesita ser rehaseado (útil para migración)
     * 
     * @param string $hash El hash a verificar
     * @return bool True si el hash necesita ser rehaseado
     */
    public static function necesitaRehash($hash) {
        // Verifica si es un hash antiguo de crypt
        return strpos($hash, '$2a$07$') === 0;
    }

    /**
     * Valida múltiples contraseñas de seguridad (para futuras mejoras)
     * 
     * @param string $contrasena La contraseña a validar
     * @param string $documento El documento del usuario (para evitar usar datos personales)
     * @return array Array con resultado de validación
     */
    public static function validacionAvanzada($contrasena, $documento = null) {
        $resultado = self::validarContrasena($contrasena);
        
        // Validación adicional: no usar el número de documento
        if ($documento && stripos($contrasena, $documento) !== false) {
            $resultado['errores'][] = "La contraseña no debe contener el número de documento.";
            $resultado['valida'] = false;
        }
        
        // Validación adicional: no usar secuencias comunes
        if (preg_match('/123|234|345|456|567|678|789|890|012|321|432|543|654|765|876|987/', $contrasena)) {
            $resultado['errores'][] = "La contraseña no debe contener secuencias numéricas consecutivas.";
            $resultado['valida'] = false;
        }
        
        return $resultado;
    }
}

?>
