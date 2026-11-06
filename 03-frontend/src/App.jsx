import { useEffect, useState } from "react";
import {
  Container,
  Box,
  Typography,
  TextField,
  Button,
  Card,
  CardContent,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  Chip,
  Stack,
} from "@mui/material";

const API_URL = import.meta.env.VITE_API_URL;

const statusValue = {
  P: "Pending",
  A: "In progress",
  F: "Finished",
  C: "Canceled",
};

function App() {
  const [orders, setOrders] = useState([]);
  const [form, setForm] = useState({ name: "", description: "", value: "" });

  const [refresh, setRefresh] = useState(false);

  useEffect(() => {
    const loadOrders = async () => {
      try {
        const res = await fetch(API_URL);
        const json = await res.json();

        setOrders(json.data || []);
      } catch (err) {
        console.error("Error loading Service Orders:", err);
      }
    };

    loadOrders();
  }, [refresh]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form),
      });

      if (response.ok) {
        setForm({ name: "", description: "", value: "" });
        setRefresh((prev) => !prev);
      }
    } catch (err) {
      console.error("Error creating Service Order:", err);
    }
  };

  const handleStatusChange = async (id, newStatus) => {
    try {
      await fetch(`${API_URL}/${id}/status`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ status: newStatus }),
      });

      setRefresh((prev) => !prev);
    } catch (err) {
      console.error("Error changing Service Order status:", err);
    }
  };

  return (
    <Container maxWidth="md" sx={{ py: 4 }}>
      <Typography
        variant="h4"
        component="h1"
        gutterBottom
        fontWeight="bold"
        color="primary"
      >
        Service Order Dashboard (SPA)
      </Typography>

      <Card sx={{ mb: 4, boxShadow: 3 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>
            New Service Order
          </Typography>
          <Box
            component="form"
            onSubmit={handleSubmit}
            sx={{ display: "flex", flexDirection: "column", gap: 2 }}
          >
            <Stack direction={{ xs: "column", sm: "row" }} spacing={2}>
              <TextField
                label="Customer name"
                variant="outlined"
                fullWidth
                required
                value={form.name}
                onChange={(e) => setForm({ ...form, name: e.target.value })}
              />

              <TextField
                label="Value ($)"
                type="number"
                inputProps={{ step: "0.01" }}
                variant="outlined"
                fullWidth
                required
                value={form.value}
                onChange={(e) => setForm({ ...form, value: e.target.value })}
              />
            </Stack>

            <TextField
              label="Service description"
              multiline
              rows={2}
              variant="outlined"
              fullWidth
              required
              value={form.description}
              onChange={(e) =>
                setForm({ ...form, description: e.target.value })
              }
            />

            <Button
              type="submit"
              variant="contained"
              size="large"
              sx={{ alignSelf: "flex-start" }}
            >
              Send
            </Button>
          </Box>
        </CardContent>
      </Card>

      <Card sx={{ boxShadow: 3 }}>
        <CardContent>
          <Typography variant="h6" gutterBottom>
            Registered Orders
          </Typography>

          <TableContainer component={Paper} elevation={0}>
            <Table sx={{ minWidth: 650 }}>
              <TableHead sx={{ bgcolor: "grey.100" }}>
                <TableRow>
                  <TableCell>
                    <strong>ID</strong>
                  </TableCell>
                  <TableCell>
                    <strong>Customer</strong>
                  </TableCell>
                  <TableCell>
                    <strong>Description</strong>
                  </TableCell>
                  <TableCell>
                    <strong>Value</strong>
                  </TableCell>
                  <TableCell>
                    <strong>Status</strong>
                  </TableCell>
                  <TableCell align="center">
                    <strong>Actions</strong>
                  </TableCell>
                </TableRow>
              </TableHead>

              <TableBody>
                {orders.length === 0 ? (
                  <TableRow>
                    <TableCell
                      colSpan={6}
                      align="center"
                      sx={{ py: 3, color: "text.secondary" }}
                    >
                      No orders registered.
                    </TableCell>
                  </TableRow>
                ) : (
                  orders.map((os) => (
                    <TableRow key={os.id} hover>
                      <TableCell>{os.id}</TableCell>
                      <TableCell>{os.name}</TableCell>
                      <TableCell>{os.description}</TableCell>
                      <TableCell>R$ {Number(os.value).toFixed(2)}</TableCell>
                      <TableCell>
                        <Chip
                          label={statusValue[os.status]}
                          color={
                            os.status === "F"
                              ? "success"
                              : os.status === "A"
                                ? "warning"
                                : "default"
                          }
                          size="small"
                        />
                      </TableCell>
                      <TableCell align="center">
                        <Stack
                          direction="row"
                          spacing={1}
                          justifyContent="center"
                        >
                          {os.status === "P" && (
                            <Button
                              size="small"
                              variant="outlined"
                              color="primary"
                              onClick={() => handleStatusChange(os.id, "A")}
                            >
                              Start
                            </Button>
                          )}
                          {os.status === "A" && (
                            <Button
                              size="small"
                              variant="contained"
                              color="success"
                              onClick={() => handleStatusChange(os.id, "F")}
                            >
                              Finish
                            </Button>
                          )}

                          {os.status === "F" && "-"}
                        </Stack>
                      </TableCell>
                    </TableRow>
                  ))
                )}
              </TableBody>
            </Table>
          </TableContainer>
        </CardContent>
      </Card>
    </Container>
  );
}

export default App;
